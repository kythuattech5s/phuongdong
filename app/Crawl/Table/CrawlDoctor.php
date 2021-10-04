<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\{Doctor,Vroutes};
use Carbon\Carbon;
class CrawlDoctor extends BaseCrawl
{
    public function crawl()
    {
    	var_dump(1);die();
    	$dataFillter = [
			'keyword' => '',
			'status' => '',
			'sort' => 'Contact.position',
			'direction' => 'DESC',
			'limit' => 20,
			'page'=> 1
		];
		// $urlListNews = 'https://benhvienphuongdong.vn/admin/login';
		// $html = $this->curlHelper->exeCurl($urlListNews,'POST',[]);
		// var_dump($html);die();
		$urlListNews = 'https://benhvienphuongdong.vn/admin/supports/list-support';
		$html = $this->curlHelper->exeCurl($urlListNews,'POST',$dataFillter);
		if (!isset($html['res'])) {
			return;
		}
		$html = str_get_html($html['res']);
		$this->convertHtmlListNew($html);
		$activePage = $html->find('.pagination li[class=active]',0);
		if (!isset($activePage)) return;
		$nextPage = $activePage->next_sibling();
		while (isset($nextPage)) {
		    $dataFillter = [
    			'keyword' => '',
				'status' => '',
				'sort' => 'Contact.position',
				'direction' => 'DESC',
				'limit' => 20,
				'page'=> (int)$nextPage->find('a',0)->innertext
    		];
    		$html = $this->curlHelper->exeCurl($urlListNews,'POST',$dataFillter);
			if (!isset($html['res'])) break;
			$html = str_get_html($html['res']);
			$this->convertHtmlListNew($html);
			$activePage = $html->find('.pagination li[class=active]',0);
			if (!isset($activePage)) break;
			$nextPage = $activePage->next_sibling();
		}
		dd('sắc sét');
    }
    public function convertHtmlListNew($html)
    {
    	$listItem = $html->find('.list-tbody tr');
    	if (!is_object($html)) {
			return;
		}
    	foreach ($listItem as $item) {
    		$listTd = $item->find('td');
    		$itemNews = new Doctor;
    		$strCreateTime 				= trim($this->htmlHelper->getAttributeDom($listTd[4],'innertext'));
    		$itemNews->created_at 		= $strCreateTime != '' ? Carbon::createFromFormat('H:i - d/m/Y',$strCreateTime):new \DateTime;
			$itemNews->ord 				= $this->htmlHelper->getAttributeDom($listTd[5]->find('input',0),'value');

    		$newRootLink 				= $this->htmlHelper->getAttributeDom($listTd[7]->find('a',0),'href');
    		$itemNews->id 				= (int)str_replace('https://benhvienphuongdong.vn/admin/supports/edit-support/','',$newRootLink);


    		$html = $this->curlHelper->exeCurl('https://benhvienphuongdong.vn/admin/supports/edit-support/'.$itemNews->id);
			if (!isset($html['res'])) {
				continue;
			}
			$html = str_get_html($html['res']);
			$itemNews->name 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=full_name]',0),'value'));
			$itemNews->slug 			= $this->htmlHelper->getAttributeDom($html->find('input[name=url]',0),'value');
			$itemNews->position 			= $this->htmlHelper->getAttributeDom($html->find('input[name=company_position]',0),'value');
			$itemNews->academic_rank 			= $this->htmlHelper->getAttributeDom($html->find('input[name=degree]',0),'value');
			$itemNews->short_content 	= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=description]',0),'innertext'));
			$itemNews->content 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=content]',0),'innertext'));
			

			$itemNews->act 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=status] option[selected]',0),'value');
			$itemNews->specialist_id 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=category_id] option[selected]',0),'value');
			$imgSource 					= $this->htmlHelper->getAttributeDom($html->find('div[id=url-img-thumbnails] img',0),'src');
			if ($imgSource != '') {
				$imgInfo = $this->mediaHelper->crawlImage($imgSource,'doi-ngu-bac-si');
				$itemNews->img 			= $imgInfo;
			}
			
    		$itemNews->save();

    		$dataVroutes = [
				'vi_name' => $itemNews->name,
				'controller' => 'App\Http\Controllers\DoctorController@view',
				'table' => 'doctors',
				'map_id' => $itemNews->id,
				'is_static' => 0,
				'in_sitemap' => 0,
				'vi_link' => $itemNews->slug,
				'created_at' => $itemNews->created_at
			];
			Vroutes::insert($dataVroutes);
    	}
    }
}