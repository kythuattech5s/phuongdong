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
        $itemCrawl->crawl();
    }
}