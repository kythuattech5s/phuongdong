<?php
namespace App\Crawl;
use \App\Helpers\Media;
class MediaHelper
{
	public function crawlImage($linkCrawl,$path){
		$uploadRootDir = 'public/uploads';
		$uploadDir = $path;
		$pathRelative = $uploadRootDir.'/'.$uploadDir.'/';
		$pathAbsolute = base_path($pathRelative);
		$dirs = explode('/', $uploadDir);
		$parentId = 0;
		foreach($dirs as $item){
			$parentId = Media::createDir($uploadRootDir, $item, $pathRelative, $pathAbsolute,$parentId);
		}
		if (is_bool($parentId)) {
			return '';
		}

		$linkCrawlInfo = pathinfo($linkCrawl);
		$currentName = isset($linkCrawlInfo['filename']) ? $linkCrawlInfo['filename']:'';
		$extention = isset($linkCrawlInfo['extension']) ? $linkCrawlInfo['extension']:'';
		if ($currentName == '' || $extention == '') return ''; 
		$fileName = $this->setFileName($pathAbsolute,$currentName,$extention).'.'.$extention;
		
		$curl = new \App\Crawl\CurlHelper;
		$res = $curl->exeCurl($linkCrawl);
		$pathMoveImg = $pathAbsolute.$fileName;
		if(empty($res['res'])) return '';
		file_put_contents($pathMoveImg, $res['res']);

		$imgId = Media::insertImageMedia($uploadRootDir, $pathAbsolute, $pathRelative, $fileName, $parentId);
		\DB::table('custom_media_images')->insert([
			'name' => $pathRelative.$fileName,
			'act' => 0,
			'created_at' => new \DateTime,
		]);
		return Media::img($imgId);
	}
	private function setFileName($path, $filename, $extention)
    {
    	$newName = $filename;
        $path_file = $path.$filename.'.'.$extention;
        $i = 1;
        while (file_exists($path_file)) {
            $newName = $filename.'-'.$i;
            $path_file = $path.$newName.'.'.$extention;
            $i++;
        }
        return $newName;
    }
}