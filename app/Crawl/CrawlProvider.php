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
            case 'partners':
                return new \App\Crawl\Table\CrawlPartner;
            case 'doctors':
                return new \App\Crawl\Table\CrawlDoctor;
            case 'specialist_category':
                return new \App\Crawl\Table\CrawlSpecialistCategory;
            case 'specialists':
                return new \App\Crawl\Table\CrawlSpecialist;
            case 'gallery':
                return new \App\Crawl\Table\CrawlGallery;
            case 'services_categories':
                return new \App\Crawl\Table\CrawlServicesCategory;
            case 'book_apointments':
                return new \App\Crawl\Table\CrawlBookApointment;
            case 'register_advises':
                return new \App\Crawl\Table\CrawlRegisterAdvise;
            default:
                throw new \Exception('Không tìm thấy code crawl cho bảng '.$table,69);
                break;
        }
    }
}