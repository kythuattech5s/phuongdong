<?php
namespace App\Helpers;
class TwoLevelSlug
{
	public static function getArrTable()
	{
		$listTable = \Cache::remember('list_table_two_level_slug', 10 * 60, function () {
    		return \DB::table('two_level_tables')->get();
		});
		$ret = [];
		foreach ($listTable as $item) {
			$ret[$item->table_name] = $item->start_url;
		}
		return $ret;
	}
	public static function convertLink($table,$link){
		$listTableTwoLevelSlug = self::getArrTable();
		if (isset($listTableTwoLevelSlug[$table])) {
			return $listTableTwoLevelSlug[$table].'/'.$link.'/';
		}
		return $link.'/';
	}
}