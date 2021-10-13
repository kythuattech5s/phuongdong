<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use \App\Models\{FileGallery,VRoutes};
use Carbon\Carbon;
class CrawlGallery extends BaseCrawl
{
    public function crawl()
    {
    	var_dump(1);die();
    	$listFile = FileGallery::get();
    	foreach ($listFile as $itemFile) {
    		$fileInfo = $this->mediaHelper->crawlImage($itemFile->link_video,'thu-vien-file/file');
    		$itemFile->file = $fileInfo;
    		$itemFile->save();
    	}
		$urlListNews = 'https://benhvienphuongdong.vn/admin/media/list-file';
		$dataFillter = [
			'page'=> 1
		];
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
				'page'=> (int)$nextPage->find('a',0)->innertext
    		];
    		$html = $this->curlHelper->exeCurl($urlListNews,'POST',$dataFillter);
			if (!isset($html['res'])) break;
			$html = str_get_html($html['res']);
			$this->convertHtmlListNew($html);
			$activePage = $html->find('.pagination li[class=active]',0);
			if (!isset($activePage)) break;
			$nextPage = $activePage->next_sibling();
			if ((int)$activePage->find('a',0)->innertext <=  (int)$nextPage->find('a',0)->innertext) {
				break;
			}
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
    		$itemNews = new FileGallery;
    		$itemNews->create_by 		= (int)str_replace('https://benhvienphuongdong.vn/admin/media/list-file?user_id=','',$this->htmlHelper->getAttributeDom($listTd[5]->find('a',0),'href'));
    		$strCreateTime 				= trim($this->htmlHelper->getAttributeDom($listTd[6]->find('p',0),'innertext'));
    		$itemNews->link_video 				= trim($this->htmlHelper->getAttributeDom($listTd[3],'innertext'));
    		$itemNews->created_at 		= $strCreateTime != '' ? Carbon::createFromFormat('H:i - d/m/Y',$strCreateTime):new \DateTime;
    		$newRootLink 				= $this->htmlHelper->getAttributeDom($listTd[8]->find('a',0),'href');
    		$itemNews->id 				= (int)str_replace('https://benhvienphuongdong.vn/admin/media/edit-file/','',$newRootLink);
    		$old = FileGallery::find($itemNews->id);
    		if (isset($old)) {
    			continue;
    		}
    		$html = $this->curlHelper->exeCurl('https://benhvienphuongdong.vn/admin/media/edit-file/'.$itemNews->id);
			if (!isset($html['res'])) {
				continue;
			}
			$html = str_get_html($html['res']);
			$itemNews->name 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=title]',0),'value'));
			$itemNews->slug 			= $this->htmlHelper->getAttributeDom($html->find('input[name=url]',0),'value');
			$itemNews->short_content 	= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=description]',0),'innertext'));
			$itemNews->content 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=content]',0),'innertext'));
			$itemNews->seo_key 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_keyword]',0),'value'));
			$itemNews->seo_title 		= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_title]',0),'value'));
			$itemNews->seo_des 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=seo_description]',0),'innertext'));

			$itemNews->share_title_facebook = html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=share_title_facebook]',0),'value'));
			$itemNews->share_description_facebook = html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=share_description_facebook]',0),'innertext'));
			$itemNews->ord 				= (int)$this->htmlHelper->getAttributeDom($html->find('input[name=position]',0),'value',0);
			$itemNews->act 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=status] option[selected]',0),'value');
			$itemNews->hot 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=featured] option[selected]',0),'value');
			$imgSource 					= $this->htmlHelper->getAttributeDom($html->find('ul[id=url-img-thumbnails] img',0),'src');
			if ($imgSource != '') {
				$imgInfo = $this->mediaHelper->crawlImage($imgSource,'thu-vien-file');
				$itemNews->img 			= $imgInfo;
			}
			$imgShareSource 			= $this->htmlHelper->getAttributeDom($html->find('input[name=share_image_facebook]',0),'value');
			if ($imgShareSource != '') {
				$pos = strpos($imgShareSource , 'http');
				if($pos === FALSE) {
					$imgShareSource = 'https://benhvienphuongdong.vn/'.$imgShareSource;
				}
				$imgShareInfo = $this->mediaHelper->crawlImage($imgShareSource,'thu-vien-file');
				$itemNews->share_image_facebook = $imgShareInfo;
			}
			$itemNews->content = $this->convertHtmlContent($itemNews->content,'thu-vien-file');
			$itemNews->short_content = $this->convertHtmlContent($itemNews->short_content,'thu-vien-file');
			$listCateId = $this->htmlHelper->getAttributeDom($html->find('input[name=categories_id]',0),'value');
			$this->createPivot($listCateId,$itemNews);
    		$itemNews->save();
    		$dataVroutes = [
				'vi_name' => $itemNews->name,
				'controller' => 'App\Http\Controllers\FileGalleryController@view',
				'table' => 'file_gallery',
				'map_id' => $itemNews->id,
				'is_static' => 0,
				'in_sitemap' => 0,
				'vi_link' => $itemNews->slug,
				'created_at' => $itemNews->created_at
			];
			Vroutes::insert($dataVroutes);
    	}
    }
    public function createPivot($listCateId,$itemNews){
    	$arrCateId = explode(',', $listCateId);
		$dataPivotCate = [];
		foreach ($arrCateId as $itemCateId) {
			$dataAdd = [];
			$dataAdd['file_gallery_id'] = $itemNews->id;
			$dataAdd['file_gallery_category_id'] = $itemCateId;
			$dataAdd['created_at'] = $itemNews->created_at;
			$dataAdd['updated_at'] = $itemNews->created_at;
			array_push($dataPivotCate, $dataAdd);
		}
		if (count($dataPivotCate) > 0) {
			\DB::table('file_gallery_file_gallery_category')->insert($dataPivotCate);
		}
    }
}