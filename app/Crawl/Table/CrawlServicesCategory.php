<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\{ServiceCategory,VRoutes};
use Carbon\Carbon;
class CrawlServicesCategory extends BaseCrawl
{
    public function crawl()
    {
    	set_time_limit(0);
    	$listItem = ServiceCategory::get();
    	foreach ($listItem as $key => $item) {
   //  		$html = $this->curlHelper->exeCurl('https://benhvienphuongdong.vn/admin/category/edit-categories/'.$item->id.'?type=products');
			// if (!isset($html['res'])) {
			// 	continue;
			// }
			// $html = str_get_html($html['res']);
			// $item->name 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=name]',0),'value'));
			// $item->slug 			= $this->htmlHelper->getAttributeDom($html->find('input[name=slug_url]',0),'value');
			// $item->parent 			= (int)$this->htmlHelper->getAttributeDom($html->find('input[name=parent_id]',0),'value',0);
			// $item->short_content 	= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=description]',0),'innertext'));
			// $item->content 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=content]',0),'innertext'));
			// $item->seo_key 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_keyword]',0),'value'));
			// $item->seo_title 		= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_title]',0),'value'));
			// $item->seo_des 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=seo_description]',0),'innertext'));
			// $item->act 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=status] option[selected]',0),'value');
			// $item->ord 				= (int)$this->htmlHelper->getAttributeDom($html->find('input[name=position]',0),'value',0);
			// $item->share_title_facebook = html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=share_title_facebook]',0),'value'));
			// $item->share_description_facebook = html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=share_description_facebook]',0),'innertext'));
			// $imgSource 					= $this->htmlHelper->getAttributeDom($html->find('ul[id=url-img-thumbnails] img',0),'src');
			// if ($imgSource != '') {
			// 	$imgInfo = $this->mediaHelper->crawlImage($imgSource,'dich-vu');
			// 	$item->img 			= $imgInfo;
			// }
			// $imgShareSource 			= $this->htmlHelper->getAttributeDom($html->find('input[name=share_image_facebook]',0),'value');
			// if ($imgShareSource != '') {
			// 	$pos = strpos($imgShareSource , 'http');
			// 	if($pos === FALSE) {
			// 		$imgShareSource = 'https://benhvienphuongdong.vn/'.$imgShareSource;
			// 	}
			// 	$imgShareInfo = $this->mediaHelper->crawlImage($imgShareSource,'dich-vu');
			// 	$item->share_image_facebook = $imgShareInfo;
			// }			$item->save();
			// $dataVroutes = [
			// 	'vi_name' => $item->name,
			// 	'controller' => 'App\Http\Controllers\ServiceCategoryController@view',
			// 	'table' => 'service_category',
			// 	'map_id' => $item->id,
			// 	'is_static' => 0,
			// 	'in_sitemap' => 0,
			// 	'vi_link' => $item->slug,
			// 	'created_at' => $item->created_at,
			// 	'updated_at' => $item->updated_at
			// ];
			// VRoutes::insert($dataVroutes);
			// $item->content = $this->convertHtmlContent($item->content,'dich-vu');
			// $item->short_content = $this->convertHtmlContent($item->short_content,'dich-vu');

   //  		$item->save();

    	}
    	dd('sắc sét');
    }
}