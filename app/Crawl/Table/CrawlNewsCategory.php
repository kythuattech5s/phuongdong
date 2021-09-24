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
    		$html = $this->curlHelper->exeCurl('https://benhvienphuongdong.vn/admin/news/edit-news/2785');
    		// $html = $this->curlHelper->exeCurl($item->url_root);
			if (!isset($html['res'])) {
				continue;
			}
			$html = str_get_html($html['res']);
			$item->name = $this->htmlHelper->getAttributeDom($html->find('input[name=name]',0),'value');
			$item->slug = $this->htmlHelper->getAttributeDom($html->find('input[name=slug_url]',0),'value');
			$item->short_content = $this->htmlHelper->getAttributeDom($html->find('textarea[name=description]',0),'innertext');
			$item->content = $this->htmlHelper->getAttributeDom($html->find('textarea[name=content]',0),'innertext');
			$item->seo_title = html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_keyword]',0),'value'));
			dd($item->toArray());
    	}
    }
}