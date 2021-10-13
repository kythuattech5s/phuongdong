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
		if ($table == 'news_categories') {
			$subSlug = self::getSpecialSubSlugByTable($table,$link);
			return $subSlug.'/'.$link.'/';
		}
		if (isset($listTableTwoLevelSlug[$table])) {
			return $listTableTwoLevelSlug[$table].'/'.$link.'/';
		}
		return $link.'/';
	}
	public static function convertSlugRoutes($route,$link)
	{
		$listTableTwoLevelSlug = self::getArrTable();
		$table = $route->table;
		$subSlug = $listTableTwoLevelSlug[$table];
		if ($table == 'news_categories') {
			$subSlug = self::getSpecialSubSlugByTable($route->table,$link);
		}
		return '/'.$subSlug.'/'.$link.'/';
	}
	public static function getSpecialSubSlugByTable($table,$link)
	{
		$subSlug = '';
		if ($table == 'news_categories') {
			$item = \DB::table('news_categories')->where('slug',$link)->first();
			if (!isset($item)) return $link.'/';
			switch ($item->type_slug) {
				case 2:
					$subSlug = 'huong-dan-khach-hang';
					break;
				default:
					$subSlug = 'tin-tuc';
					break;
			}
		}
		return $subSlug;
	}
	public static function checkLinkSegmentBeforGetRoutest($link)
	{
		$listTableTwoLevelSlug = self::getArrTable();
		$tableAccess = null;
		$oldLink = $link;
		if ($link == 'huong-dan-khach-hang') {
			$tableAccess = 'news_categories';
			$link = \Support::getSegment(request(), 2);
			if ($link == '') {
				return [$oldLink,$tableAccess];
			}
			$item = \DB::table('news_categories')->where('slug',$link)->first();
			if (!isset($item)) abort(404);
			if ($item->type_slug != 2) {
				abort(404);
			}
			return [$link,$tableAccess];
		}
		if (in_array($link,$listTableTwoLevelSlug) && \Support::getSegment(request(), 2) != '') {
            $tableAccess = array_search($link, $listTableTwoLevelSlug);
            $link = \Support::getSegment(request(), 2);
            if ($tableAccess == 'news_categories') {
				$subSlug = self::getSpecialSubSlugByTable($tableAccess,$link);
				if ($subSlug != $oldLink) {
					abort(404);
				}
			}
        }
        return [$link,$tableAccess];
	}
}