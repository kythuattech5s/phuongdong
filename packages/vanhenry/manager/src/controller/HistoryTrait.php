<?php
namespace vanhenry\manager\controller;

use vanhenry\manager\model\VConfigRegion;
use vanhenry\manager\model\Config;
use vanhenry\manager\model\VDetailTable;
use vanhenry\manager\model\TableProperty;
use Illuminate\Support\Facades\Schema;
use App\Models\FlashSaleTimeSlot;
use DB;
use FCHelper;

trait HistoryTrait
{
    public function history($table,$id)
    {
        $history_table = 'h_histories';
        $tableData = self::__getListTable()[$history_table];
		$tableDetailData = self::__getListDetailTable($history_table);
        
        $data['tableData'] = collect($tableData);
        $tmp = collect($tableDetailData);
        $addDetailData = $this->_getTableProperties($data['tableData']->get("id"));
        $merge = $tmp->merge($addDetailData);
        //Thông tin chi tiết bảng
        $data['tableDetailData'] = $tmp;
        $data['table_history_config'] = $table;
        $listData = $this->getDataTableById($history_table, $data, $table, $id);
        $data["listData"] = $this->_getDataFromTableProperties($history_table,$addDetailData,$listData);
        $view = 'vh::view.new_history';
        return view($view, $data);
    }

    public function getDataTableById($history_table, $data, $table, $id){
        $listData = DB::table($history_table)->where('table_name',$table);
        if($id != 0){
            $listData->where('target_id',$id);
        }
        $listData = $listData->orderBy('id','DESC')->paginate(20);
        return $listData;
    }
}