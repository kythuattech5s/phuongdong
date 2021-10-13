<?php
namespace App\Helpers;
class Utm
{
	const UTM_SESSION_KEY = 'UTM_SESSION_KEY';
	private static function checkDataInfo($arrInfo,$key){
		$value = isset($arrInfo[$key]) ? $arrInfo[$key]:'';
		$valueGet = request()->input($key);
		$newValue = isset($valueGet) ? $valueGet:'';
		if ($newValue != '') {
			$value = $newValue;
		}
		return $value;
	}
	public static function check()
	{
		$infoSession = request()->session()->has(self::UTM_SESSION_KEY) ? request()->session()->get(self::UTM_SESSION_KEY):[];
		$infoSession["utm_source"] 		= self::checkDataInfo($infoSession,'utm_source');
		$infoSession["utm_medium"] 		= self::checkDataInfo($infoSession,'utm_medium');
		$infoSession["utm_campaign"] 	= self::checkDataInfo($infoSession,'utm_campaign');
		$infoSession["utm_content"] 	= self::checkDataInfo($infoSession,'utm_content');
		$infoSession["utm_term"] 		= self::checkDataInfo($infoSession,'utm_term');
		request()->session()->put(self::UTM_SESSION_KEY, $infoSession);
	}
	public static function get()
	{
		$infoSession = request()->session()->has(self::UTM_SESSION_KEY) ? request()->session()->get(self::UTM_SESSION_KEY):[];
		$ret["utm_source"] 		= isset($infoSession['utm_source']) && $infoSession['utm_source'] != '' ? $infoSession['utm_source']:'Direct';
		$ret["utm_medium"] 		= isset($infoSession['utm_medium']) ? $infoSession['utm_medium']:'';
		$ret["utm_campaign"] 	= isset($infoSession['utm_campaign']) ? $infoSession['utm_campaign']:'';
		$ret["utm_content"] 	= isset($infoSession['utm_content']) ? $infoSession['utm_content']:'';
		$ret["utm_term"] 		= isset($infoSession['utm_term']) ? $infoSession['utm_term']:'';
		return $ret;
	}
}