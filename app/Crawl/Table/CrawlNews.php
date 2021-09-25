<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\{News,Vroutes,NewsNewsCategory};
use Carbon\Carbon;
class CrawlNews extends BaseCrawl
{
    public function crawl()
    {
    	set_time_limit(0);
		$urlListNews = 'https://benhvienphuongdong.vn/admin/news/list-news';
		$html = $this->curlHelper->exeCurl($urlListNews);
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
    			'keyword'=>'', 
				'category_filter'=>'',
				'user_id'=>'',
				'up_by'=>'',
				'featured'=>'',
				'status'=>'',
				'language'=>'vie',
				'sort'=>'News.position',
				'direction'=>'DESC',
				'position'=>'1138',
				'limit'=>'20',
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
    	foreach ($listItem as $item) {
    		$listTd = $item->find('td');
    		$itemNews = new News;

    		$itemNews->create_by 		= (int)str_replace('https://benhvienphuongdong.vn/admin/news/list-news?user_id=','',$this->htmlHelper->getAttributeDom($listTd[4]->find('a',0),'href'));
    		$itemNews->update_by 		= (int)str_replace('https://benhvienphuongdong.vn/admin/news/list-news?user_id=','',$this->htmlHelper->getAttributeDom($listTd[6]->find('a',0),'href'));

    		$strCreateTime 				= $this->htmlHelper->getAttributeDom($listTd[5]->find('p',0),'innertext');
    		$strUpdateTime 				= $this->htmlHelper->getAttributeDom($listTd[7]->find('p',0),'innertext');
    		$itemNews->created_at 		= $strCreateTime != '' ? Carbon::createFromFormat('H:i - d/m/Y',$strCreateTime):new \DateTime;
    		if ($strUpdateTime) {
    			$itemNews->updated_at 	= Carbon::createFromFormat('H:i - d/m/Y',$strUpdateTime);
    		}

    		$itemNews->count_view 		= (int)$this->htmlHelper->getAttributeDom($listTd[9]->find('p',0),'innertext');
    		$newRootLink 				= $this->htmlHelper->getAttributeDom($listTd[12]->find('a',0),'href');
    		$itemNews->root_url 		= $newRootLink;
    		$itemNews->root_id 			= str_replace('https://benhvienphuongdong.vn/admin/news/edit-news/','',$newRootLink);
    		$itemNews->id 				= $itemNews->root_id;

    		$html = $this->curlHelper->exeCurl($itemNews->root_url);
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

			$itemNews->act 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=status] option[selected]',0),'value');
			$itemNews->doctor_id 		= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=doctor_id] option[selected]',0),'value');
			$strPublishTime 			= $this->htmlHelper->getAttributeDom($html->find('input[name=publish_date]',0),'value');
			$itemNews->time_published 	= $strPublishTime != '' ? Carbon::createFromFormat('d/m/Y H:i:s',$strPublishTime):$itemNews->created_at;
			$itemNews->ord 				= (int)$this->htmlHelper->getAttributeDom($html->find('input[name=position]',0),'value',0);

			$imgSource 					= $this->htmlHelper->getAttributeDom($html->find('div[id=url-img-thumbnails] img',0),'src');
			if ($imgSource != '') {
				$imgInfo = $this->mediaHelper->crawlImage($imgSource,'tin-tuc');
				$itemNews->img 			= $imgInfo;
				$itemNews->share_image_facebook = $imgInfo;
			}

			$itemNews->content = $this->convertHtmlContent($itemNews->content,'tin-tuc');
			$itemNews->short_content = $this->convertHtmlContent($itemNews->short_content,'tin-tuc');


			$listCateId = $this->htmlHelper->getAttributeDom($html->find('input[name=categories_id]',0),'value');
			$this->createPivot($listCateId,$itemNews);
    		$itemNews->save();

    		$dataVroutes = [
				'vi_name' => $itemNews->name,
				'controller' => 'App\Http\Controllers\NewsController@view',
				'table' => 'news_categories',
				'map_id' => $itemNews->id,
				'is_static' => 0,
				'in_sitemap' => 0,
				'vi_link' => $itemNews->slug,
				'created_at' => $itemNews->created_at,
				'updated_at' => $itemNews->updated_at
			];
			Vroutes::insert($dataVroutes);
			var_dump(1);die();
    	}
    }
    public function createPivot($listCateId,$itemNews){
    	$arrCateId = explode(',', $listCateId);
		$dataPivotCate = [];
		foreach ($arrCateId as $itemCateId) {
			$dataAdd = [];
			$dataAdd['news_id'] = $itemNews->id;
			$dataAdd['news_category_id'] = $itemCateId;
			$dataAdd['created_at'] = $itemNews->created_at;
			$dataAdd['updated_at'] = $itemNews->created_at;
			array_push($dataPivotCate, $dataAdd);
		}
		if (count($dataPivotCate) > 0) {
			NewsNewsCategory::insert($dataPivotCate);
		}
    }
}