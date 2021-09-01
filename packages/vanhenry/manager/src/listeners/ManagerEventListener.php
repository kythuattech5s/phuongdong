<?php 
namespace vanhenry\manager\listeners;
use vanhenry\manager\model\HHistory;
class ManagerEventListener
{
    public function subscribe($events)
    {
        $events->listen('vanhenry.manager.update_normal.preupdate', PreUpdate::class);
        $events->listen('vanhenry.manager.insert.preinsert', PreUpdate::class);
        $events->listen('vanhenry.manager.delete.predelete', PreDelete::class);
        $events->listen('vanhenry.manager.delete.predelete', function ($table, $id)
        {
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->name;
            }

            /* Xóa thông tin phân quyền user */
            $arrIdSp = $id;
            $userAdmin = \Auth::guard('h_users')->user();
            if (is_array($arrIdSp)) {
                \DB::table('h_user_record_maps')->where('table_name',$tbl)->where('h_user_id',$userAdmin->id)->whereIn('target_id',$arrIdSp)->delete();
            }else {
                \DB::table('h_user_record_maps')->where('table_name',$tbl)->where('h_user_id',$userAdmin->id)->where('target_id',$arrIdSp)->delete();
            }
            /* End xóa thông tin phân quyền user */

            $id = is_array($id) ? implode(",", $id) : $id;
            $name = "Delete " . $tbl;
            $content = "Delete " . $tbl . " id = " . $id;
            $this->insertHistory($name, $content);
            return array(
                "status" => true
            );
        });
        $events->listen('vanhenry.manager.insert.success', function ($table, $data, $injects, $id)
        {
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->name;
            }

            /* Thêm thông tin phân quyền */
            $userAdmin = \Auth::guard('h_users')->user();
            $dataCreate = [];
            $dataCreate['h_user_id']    = $userAdmin->id;
            $dataCreate['table_name']   = $table->table_map;
            $dataCreate['target_id']    = $id;
            $dataCreate['created_at']   = new \DateTime;
            $dataCreate['updated_at']   = new \DateTime;
            \DB::table('h_user_record_maps')->insert($dataCreate);
            /* End thêm thông tin phân quyền */
            
            $name = "Insert " . $tbl;
            $content = "Insert " . $tbl . " id = " . $id . (isset($data["name"]) ? " name " . $data["name"] : "");
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.trash.success', function ($table, $id, $value)
        {
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->name;
            }
            $type = $value == 1 ? "Trash" : "Restore";
            $name = $type . " " . $tbl;
            $content = $type . " " . $tbl . " id = " . $id;
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.update_normal.success', function ($table, $data, $injects, $id)
        {
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->name;
            }
            $name = "Update Normal " . $tbl;
            $content = "Update " . $tbl . " id = " . $id . (isset($data["name"]) ? " name " . $data["name"] : "");
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.update_config.success', function ($table, $data, $id)
        {
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->name;
            }
            $name = "Update Configs " . $tbl;
            $content = "Update " . $tbl . " id = " . $id;
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.addtoparent.success', function ($table, $parent, $arrId)
        {
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->name;
            }
            $name = "Remove From Parent " . $tbl;
            $content = "Update " . $tbl . " remove from parent with parent = " . $parent . " id = " . implode(",", $arrId);
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.removefromparent.success', function ($table, $parent, $arrId)
        {
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->name;
            }
            $name = "Add To Parent " . $tbl;
            $content = "Update " . $tbl . " add to parent with parent = " . $parent . " id = " . implode(",", $arrId);
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.doassign.success', function ($table, $group_user)
        {
            $tbl = $table;
            if ($table instanceof \vanhenry\manager\model\VTable)
            {
                $tbl = $table->name;
            }
            $name = "Assign " . $tbl;
            $content = "Update " . $tbl . " assign group user  = " . $group_user;
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.media.delete.success', function ($fname, $id)
        {
            $name = "Delete Media";
            $content = "Delete Media id = " . $id . " name = " . $fname;
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.media.createdir.success', function ($folder_name, $id)
        {
            $name = "Create Folder Media";
            $content = "Create Folder Media id = " . $id . " folder = " . $folder_name;
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.media.insert.success', function ($name, $id)
        {
            $name = "Upload Image Media";
            $content = "Upload Image Media id = " . $id . " name = " . $name;
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.media.update.success', function ($name, $id)
        {
            $name = "Update Media";
            $content = "Update Media id = " . $id . " name = " . $name;
            $this->insertHistory($name, $content);
        });
        $events->listen('vanhenry.manager.media.convert.img.via.cron', function ($path)
        {
            \DB::table('custom_media_images')->insert([
                'name' => $path,
                'act' => 0,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ]);
        });
    }
    private function insertHistory($name, $content)
    {
        $h = new HHistory;
        $h->name = $name;
        $h->content = $content;
        $h->ip = request()->ip();
        $h->username = \Auth::guard("h_users")->user()->name;
        $h->id_user = \Auth::guard("h_users")->id();
        $h->save();
    }
}

