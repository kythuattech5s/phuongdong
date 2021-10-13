<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\{RegisterAdvise};
use Carbon\Carbon;
class CrawlRegisterAdvise extends BaseCrawl
{
    public function crawl()
    {
    	set_time_limit(0);
		$urlListNews = 'https://benhvienphuongdong.vn/admin/contact/list-contact';
		$dataFillter = [
			'page'=> 1
		];
		$html = $this->curlHelper->exeCurl($urlListNews,'POST',$dataFillter);
		if (!isset($html['res'])) {
			return;
		}
		$html = str_get_html($html['res']);
		$this->convertHtml($html);
		$activePage = $html->find('.pagination li[class=active]',0);
		if (!isset($activePage)) return;
		$nextPage = $activePage->next_sibling();
		while (isset($nextPage)) {
		    $dataFillter = [
				'page'=> (int)$nextPage->find('a',0)->innertext
    		];
    		$html = $this->curlHelper->exeCurl($urlListNews,'POST',$dataFillter);
			if (!isset($html['res'])) break;
			$html = str_get_html($html['res']);
			$this->convertHtml($html);
			$activePage = $html->find('.pagination li[class=active]',0);
			if (!isset($activePage)) break;
			$nextPage = $activePage->next_sibling();
		}
		dd('sắc sét');
    }
    public function convertHtml($html)
    {
    	$arrUtmKey = [
    		'utm_source',
			'utm_medium',
			'utm_campaign',
			'utm_content',
			'utm_term'
    	];
    	$listItem = $html->find('.list-tbody tr');
    	if (!is_object($html)) {
			return;
		}
    	foreach ($listItem as $item) {
    		$listTd = $item->find('td');
    		$item = new RegisterAdvise;
    		$item->title			= trim($this->htmlHelper->getAttributeDom($listTd[1]->find('a',0),'innertext'));
    		$item->fullname			= trim($this->htmlHelper->getAttributeDom($listTd[2],'innertext'));

    		$phoneEmailInfo 		= $listTd[3]->find('p');
    		if (isset($phoneEmailInfo[0])) {
    			$item->phone = $this->htmlHelper->getAttributeDom($phoneEmailInfo[0],'innertext');
    		}
    		if (isset($phoneEmailInfo[1])) {
    			$item->email = $this->htmlHelper->getAttributeDom($phoneEmailInfo[1],'innertext');
    		}
    		$item->note				= trim($this->htmlHelper->getAttributeDom($listTd[4],'innertext'));
    		
    		$itemRootLink 			= $this->htmlHelper->getAttributeDom($listTd[8]->find('a',0),'href');
    		$item->id 				= (int)str_replace('https://benhvienphuongdong.vn/admin/contact/view-contact/','',$itemRootLink);
    		$listUtmInfo = $listTd[5]->find('p');
    		foreach ($listUtmInfo as $itemUtm) {
    			$strUtm = $this->htmlHelper->getAttributeDom($itemUtm,'innertext');
    			$arrUtmInfo = explode(':', $strUtm);
    			if (count($arrUtmInfo) == 2 && in_array(trim($arrUtmInfo[0]), $arrUtmKey)) {
    				$keyUtm = trim($arrUtmInfo[0]);
    				$item->$keyUtm = trim($arrUtmInfo[1]);
    			}
    		}
    		$strCreateTime 			= $this->htmlHelper->getAttributeDom($listTd[6],'innertext');
    		$item->created_at 		= $strCreateTime != '' ? Carbon::createFromFormat('H:i - d/m/Y',trim($strCreateTime)):new \DateTime;
    		$item->text_read 		= trim($this->htmlHelper->getAttributeDom($listTd[7]->find('a',0),'innertext'));
    		$item->save();
    	}
    }
}