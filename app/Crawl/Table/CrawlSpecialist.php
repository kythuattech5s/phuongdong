<?php
namespace App\Crawl\Table;
use App\Crawl\BaseCrawl;
use App\Models\{Specialist,Vroutes};
use Carbon\Carbon;
class CrawlSpecialist extends BaseCrawl
{
    public function crawl()
    {
    	var_dump(1);die();
    	set_time_limit(0);
		$urlListNews = 'https://benhvienphuongdong.vn/admin/introduce/list-introduces';
		$html = $this->curlHelper->exeCurl($urlListNews);
		if (!isset($html['res'])) {
			return;
		}
		$html = str_get_html($html['res']);
		$this->convertHtmlListNew($html);
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
    		$item = new Specialist;

    		$item->create_by 		= (int)str_replace('https://benhvienphuongdong.vn/admin/introduce/list-introduces?user_id=','',$this->htmlHelper->getAttributeDom($listTd[3]->find('a',0),'href'));
    		$item->update_by 		= (int)str_replace('https://benhvienphuongdong.vn/admin/introduce/list-introduces?user_id=','',$this->htmlHelper->getAttributeDom($listTd[5]->find('a',0),'href'));

    		$strCreateTime 				= $this->htmlHelper->getAttributeDom($listTd[4]->find('p',0),'innertext');
    		$strUpdateTime 				= $this->htmlHelper->getAttributeDom($listTd[6]->find('p',0),'innertext');
    		$item->created_at 		= $strCreateTime != '' ? Carbon::createFromFormat('d/m/Y',$strCreateTime):new \DateTime;
    		if ($strUpdateTime) {
    			$item->updated_at 	= Carbon::createFromFormat('H:i - d/m/Y',$strUpdateTime);
    		}

    		$newRootLink 				= $this->htmlHelper->getAttributeDom($listTd[10]->find('a',0),'href');
    		$item->id 				= (int)str_replace('https://benhvienphuongdong.vn/admin/introduce/edit-introduce/','',$newRootLink);

    		$html = $this->curlHelper->exeCurl('https://benhvienphuongdong.vn/admin/introduce/edit-introduce/'.$item->id);
			if (!isset($html['res'])) {
				continue;
			}
			$html = str_get_html($html['res']);
			$item->name 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=name]',0),'value'));
			$item->slug 			= $this->htmlHelper->getAttributeDom($html->find('input[name=url]',0),'value');
			$item->short_content 	= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=description]',0),'innertext'));
			$item->content 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=content]',0),'innertext'));
			$item->seo_key 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_keyword]',0),'value'));
			$item->seo_title 		= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=seo_title]',0),'value'));
			$item->seo_des 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=seo_description]',0),'innertext'));

			$item->share_title_facebook = html_entity_decode($this->htmlHelper->getAttributeDom($html->find('input[name=share_title_facebook]',0),'value'));
			$item->share_description_facebook = html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[name=share_description_facebook]',0),'innertext'));

			$item->act 				= (int)$this->htmlHelper->getAttributeDom($html->find('select[name=status] option[selected]',0),'value');
			$item->ord 				= (int)$this->htmlHelper->getAttributeDom($html->find('input[name=position]',0),'value',0);

			$imgSource 					= $this->htmlHelper->getAttributeDom($html->find('div[id=url-img-thumbnails] img',0),'src');
			if ($imgSource != '') {
				$imgInfo = $this->mediaHelper->crawlImage($imgSource,'chuyen-khoa');
				$item->img 			= $imgInfo;
			}
			$imgShareSource 			= $this->htmlHelper->getAttributeDom($html->find('input[name=share_image_facebook]',0),'value');
			if ($imgShareSource != '') {
				$pos = strpos($imgShareSource , 'http');
				if($pos === FALSE) {
					$imgShareSource = 'https://benhvienphuongdong.vn/'.$imgShareSource;
				}
				$imgShareInfo = $this->mediaHelper->crawlImage($imgShareSource,'chuyen-khoa');
				$item->share_image_facebook = $imgShareInfo;
			}
			$item->content = $this->convertHtmlContent($item->content,'chuyen-khoa');
			$item->short_content = $this->convertHtmlContent($item->short_content,'chuyen-khoa');

    		$item->save();

    		$dataVroutes = [
				'vi_name' => $item->name,
				'controller' => 'App\Http\Controllers\SpecialistController@view',
				'table' => 'specialists',
				'map_id' => $item->id,
				'is_static' => 0,
				'in_sitemap' => 0,
				'vi_link' => $item->slug,
				'created_at' => $item->created_at,
				'updated_at' => $item->updated_at,
				'vi_seo_title' => $item->seo_title,
				'vi_seo_key' => $item->seo_key,
				'vi_seo_des' => $item->seo_des
			];
			Vroutes::insert($dataVroutes);
    	}
    }
    public function crawlDb(){
    	var_dump(1);die();
    	$listItem = Specialist::get();
    	foreach ($listItem as $item) {
    		$html = $this->curlHelper->exeCurl('https://benhvienphuongdong.vn/admin/introduce/edit-introduce/'.$item->id);
			if (!isset($html['res'])) {
				continue;
			}
			$html = str_get_html($html['res']);
			$item->content 			= html_entity_decode($this->htmlHelper->getAttributeDom($html->find('textarea[id=wysiwyg_content]',0),'innertext'));
			$item->content = $this->convertHtmlContent($item->content,'chuyen-khoa');
			$item->save();
    	}
    	var_dump('éc éc');die();
    }
}