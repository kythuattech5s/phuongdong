<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\NewsCategory;
class CrawlNewsCategory extends BaseCrawl
{
    public function crawl()
    {
    	set_time_limit(0);
    	$listNew = NewsCategory::get();
    	foreach ($listNew as $item) {
    		$html = $this->curlHelper->exeCurl($item->url_root);
			if (!isset($html['res'])) {
				continue;
			}
			$html = str_get_html($html['res']);

			$item->name 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=name]',0),'value'));
			$item->slug 			= $this->htmlHelper->getAttributeDom($html->find('input[name=slug_url]',0),'value');
			$item->parent 			= (int)$this->htmlHelper->getAttributeDom($html->find('input[name=parent_id]',0),'value',0);
			$item->short_content 	= $this->htmlHelper->getAttributeDom($html->find('textarea[name=description]',0),'innertext');
			$item->content 			= $this->htmlHelper->getAttributeDom($html->find('textarea[name=content]',0),'innertext');
			$item->seo_key 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_keyword]',0),'value'));
			$item->seo_title 		= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_title]',0),'value'));
			$item->seo_des 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=seo_description]',0),'innertext'));
			$item->act 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=status] option[selected]',0),'value');
			$item->ord 				= (int)$this->htmlHelper->getAttributeDom($html->find('input[name=position]',0),'value',0);
			$item->created_at 		= new \DateTime;
			$item->updated_at 		= new \DateTime;

			dd($item->toArray());
    	}
    }
}