<?php
namespace App\Crawl;
use ModuleCrawler\Helper\Curl;
class HtmlHelper
{
	public function getAttributeDom($dom,$attribute,$default = '')
	{
		if (isset($dom) && is_object($dom)) {
			if (isset($dom->$attribute)) {
				return $dom->$attribute;
			}
		}
		return $default;
	}
}