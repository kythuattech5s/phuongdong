<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Crawl\CrawlProvider;
class CrawlController extends Controller
{
    public function doCrawl($table)
    {
        $crawlProvider = new CrawlProvider;
        $itemCrawl = $crawlProvider->getCrawler($table);
        $type = request()->input('type');
        switch ($type) {
        	case 'db':
        		$itemCrawl->crawlDb();
        		break;
        	default:
        		$itemCrawl->crawl();
        		break;
        }
    }
}