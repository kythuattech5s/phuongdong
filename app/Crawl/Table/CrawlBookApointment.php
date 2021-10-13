<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\{BookApointment};
use Carbon\Carbon;
class CrawlBookApointment extends BaseCrawl
{
    public function crawl()
    {
    	var_dump(1);die();
    	set_time_limit(0);
  //   	$urlListNews = 'https://benhvienphuongdong.vn/admin/login';
		// $html = $this->curlHelper->exeCurl($urlListNews,'POST',[]);
		// var_dump($html);die();
		$urlListNews = 'https://benhvienphuongdong.vn/admin/hospital/list-medical-register';
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
    		$item = new BookApointment;
    		$strCreateTime 				= $this->htmlHelper->getAttributeDom($listTd[7],'innertext');
    		$item->created_at 		= $strCreateTime != '' ? Carbon::createFromFormat('d/m/Y H:i',trim($strCreateTime)):new \DateTime;
    		$itemRootLink 				= $this->htmlHelper->getAttributeDom($listTd[8]->find('a',0),'href');
    		$item->id 				= (int)str_replace('https://benhvienphuongdong.vn/admin/hospital/edit/','',$itemRootLink);
    		$listUtmInfo = $listTd[5]->find('p');
    		foreach ($listUtmInfo as $itemUtm) {
    			$strUtm = $this->htmlHelper->getAttributeDom($itemUtm,'innertext');
    			$arrUtmInfo = explode(':', $strUtm);
    			if (count($arrUtmInfo) == 2 && in_array(trim($arrUtmInfo[0]), $arrUtmKey)) {
    				$keyUtm = trim($arrUtmInfo[0]);
    				$item->$keyUtm = trim($arrUtmInfo[1]);
    			}
    		}
    		$html = $this->curlHelper->exeCurl('https://benhvienphuongdong.vn/admin/hospital/edit/'.$item->id);
			if (!isset($html['res'])) {
				continue;
			}
			$html = str_get_html($html['res']);
			$item->fullname 		= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=full_name]',0),'value'));
			$item->service_id 		= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=service] option[selected]',0),'value');
			$item->age 			= $this->htmlHelper->getAttributeDom($html->find('input[name=old]',0),'value');
			$item->phone 			= $this->htmlHelper->getAttributeDom($html->find('input[name=phone]',0),'value');
			$item->email 			= $this->htmlHelper->getAttributeDom($html->find('input[name=email]',0),'value');
			$item->day_book 			= $this->htmlHelper->getAttributeDom($html->find('input[name=appointment_date]',0),'value');
			$item->time_pick_text 		= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('select[name=appointment_time] option[selected]',0),'innertext'));
			$item->note 			= $this->htmlHelper->getAttributeDom($html->find('textarea[name=problem]',0),'innertext');
			$item->status 		= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=status] option[selected]',0),'value');
			$item->doctor_id 		= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=doctor] option[selected]',0),'value');
    		$item->save();
    	}
    }
}