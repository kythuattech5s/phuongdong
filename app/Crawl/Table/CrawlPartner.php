<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\{Partner};
use Carbon\Carbon;
class CrawlPartner extends BaseCrawl
{
    public function crawl()
    {
    	set_time_limit(0);
		$urlListNews = 'https://benhvienphuongdong.vn/admin/partner/list-partner';
		$html = $this->curlHelper->exeCurl($urlListNews);
		if (!isset($html['res'])) {
			return;
		}
		$html = str_get_html($html['res']);
		$this->convertHtml($html);
		dd('sắc sét');
    }
    public function convertHtml($html)
    {
    	$listItem = $html->find('.list-tbody tr');
    	if (!is_object($html)) {
			return;
		}
    	foreach ($listItem as $item) {
    		$listTd = $item->find('td');
    		$item = new Partner;
    		$strCreateTime 				= $this->htmlHelper->getAttributeDom($listTd[4]->find('p',0),'innertext');
    		$item->created_at 		= $strCreateTime != '' ? Carbon::createFromFormat('d/m/Y',$strCreateTime):new \DateTime;
    		$item->ord 				= (int)$this->htmlHelper->getAttributeDom($listTd[5]->find('input',0),'value');
    		$itemRootLink 				= $this->htmlHelper->getAttributeDom($listTd[7]->find('a',0),'href');
    		$item->id 				= (int)str_replace('https://benhvienphuongdong.vn/admin/partner/edit-partner/','',$itemRootLink);
    		$html = $this->curlHelper->exeCurl('https://benhvienphuongdong.vn/admin/partner/edit-partner/'.$item->id);
			if (!isset($html['res'])) {
				continue;
			}
			$html = str_get_html($html['res']);
			$item->name 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=name]',0),'value'));
			$item->phone 			= $this->htmlHelper->getAttributeDom($html->find('input[name=phone]',0),'value');
			$item->link 			= $this->htmlHelper->getAttributeDom($html->find('input[name=url]',0),'value');
			$item->short_content 	= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=description]',0),'innertext'));
			$item->content 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=content]',0),'innertext'));
			$item->act 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=status] option[selected]',0),'value');
			$imgSource 				= $this->htmlHelper->getAttributeDom($html->find('ul[id=url-img-thumbnails] img',0),'src');
			if ($imgSource != '') {
				$imgInfo = $this->mediaHelper->crawlImage($imgSource,'doi-tac');
				$item->img 			= $imgInfo;
			}
			$item->content = $this->convertHtmlContent($item->content,'doi-tac');
			$item->short_content = $this->convertHtmlContent($item->short_content,'doi-tac');
    		$item->save();
    	}
    }
}