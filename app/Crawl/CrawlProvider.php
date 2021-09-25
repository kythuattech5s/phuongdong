<?php
namespace App\Crawl;
class CrawlProvider
{
    public function getCrawler($table)
    {
        switch ($table) {
            case 'news_categories':
                return new \App\Crawl\Table\CrawlNewsCategory;
            case 'news':
                return new \App\Crawl\Table\CrawlNews;
            default:
                throw new \Exception('Không tìm thấy code crawl cho bảng '.$table,69);
                break;
        }
    }
}