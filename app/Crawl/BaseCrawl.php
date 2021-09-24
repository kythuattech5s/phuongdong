<?php
namespace App\Crawl;
use App\Crawl\{CurlHelper,HtmlHelper};
class BaseCrawl
{
	protected $curlHelper;
	public function __construct(){
		$this->curlHelper = new CurlHelper;
		$this->htmlHelper = new HtmlHelper;
		include('simple_html_dom.php');
	}
    public function crawl()
    {
    	dd('Chưa có hàm crawl chi tiết');
    }
}