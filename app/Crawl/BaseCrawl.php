<?php
namespace App\Crawl;
use App\Crawl\{CurlHelper,HtmlHelper,MediaHelper};
class BaseCrawl
{
	protected $curlHelper;
	public function __construct(){
		$this->curlHelper = new CurlHelper;
		$this->htmlHelper = new HtmlHelper;
		$this->mediaHelper = new MediaHelper;
		include('simple_html_dom.php');
	}
	public function convertHtmlContent($content,$pathSave){
		$html = str_get_html($content);
		if (!is_object($html)) {
			return $content;
		}
		$imgs = $html->find('img');
		foreach ($imgs as $item) {
			$imgSource = $this->htmlHelper->getAttributeDom($item,'src');
			$pos = strpos($imgSource , 'http');
			if($pos === FALSE) {
				$imgSource = str_replace('../../..','https://benhvienphuongdong.vn',$imgSource);
			}
			if ($imgSource != '') {
				$imgInfo = $this->mediaHelper->crawlImage($imgSource,$pathSave);
				$arrImgInfo = json_decode($imgInfo,true);
				if (!isset($arrImgInfo['path']) || !isset($arrImgInfo['file_name'])) {
					continue;
				}
				$newSrc = $arrImgInfo['path'].$arrImgInfo['file_name'];
				$item->setAttribute('src',$newSrc);
			}
		}
		$html->save();
		return (string)$html;
    }
    public function crawl()
    {
    	dd('Chưa có hàm crawl chi tiết');
    }
}