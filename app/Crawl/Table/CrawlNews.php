<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\{News,Vroutes};
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
			if (!isset($html['res'])) {
				break;
			}
			$html = str_get_html($html['res']);
			$this->convertHtmlListNew($html);
			$activePage = $html->find('.pagination li[class=active]',0);
			if (!isset($activePage)) break;
			$nextPage = $activePage->next_sibling();
		}
    }
    public function convertHtmlListNew($html)
    {
    	$listItem = $html->find('.list-tbody tr');
    	foreach ($listItem as $item) {
    		$listTd = $item->find('td');
    		$itemNews = new News;

    		$itemNews->create_by = (int)str_replace('https://benhvienphuongdong.vn/admin/news/list-news?user_id=','',$this->htmlHelper->getAttributeDom($listTd[4]->find('a',0),'href'));
    		$itemNews->update_by = (int)str_replace('https://benhvienphuongdong.vn/admin/news/list-news?user_id=','',$this->htmlHelper->getAttributeDom($listTd[6]->find('a',0),'href'));

    		$strCreateTime = $this->htmlHelper->getAttributeDom($listTd[5]->find('p',0),'innertext');
    		$strUpdateTime = $this->htmlHelper->getAttributeDom($listTd[7]->find('p',0),'innertext');
    		$itemNews->created_at = Carbon::createFromFormat('H:i - d/m/Y',$strCreateTime);
    		$itemNews->updated_at = Carbon::createFromFormat('H:i - d/m/Y',$strUpdateTime);
    		$itemNews->count_view = (int)$this->htmlHelper->getAttributeDom($listTd[9]->find('p',0),'innertext');

    		$newRootLink = $this->htmlHelper->getAttributeDom($listTd[12]->find('a',0),'href');
    		$itemNews->root_url = $newRootLink;
    		$itemNews->root_id = str_replace('https://benhvienphuongdong.vn/admin/news/edit-news/','',$newRootLink);
    		$itemNews->id = $itemNews->root_id;
    		// $itemNews->save();
    	}
    }
}