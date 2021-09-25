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
		$imgs = $html->find('img');
		foreach ($imgs as $item) {
			$fullSrc = str_replace('../../..','https://benhvienphuongdong.vn',$this->htmlHelper->getAttributeDom($item,'src'));
			if ($fullSrc != '') {
				$imgInfo = $this->mediaHelper->crawlImage($fullSrc,$pathSave);
				$arrImgInfo = json_decode($imgInfo,true);
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