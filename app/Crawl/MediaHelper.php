<?php
namespace App\Crawl;
use \App\Helpers\Media;
class MediaHelper
{
	public function replaceURL($string){
	    $string=strtolower($string);
	    $str = str_replace('-', ' ', $string);
	    $utf8characters = 'à|a, ả|a, ã|a, á|a, ạ|a, ă|a, ằ|a, ẳ|a, ẵ|a,  ắ|a, ặ|a, â|a, ầ|a, ẩ|a, ẫ|a, ấ|a, ậ|a, đ|d, è|e, ẻ|e, ẽ|e, é|e, ẹ|e,  ê|e, ề|e, ể|e, ễ|e, ế|e, ệ|e, ì|i, ỉ|i, ĩ|i, í|i, ị|i, ò|o, ỏ|o, õ|o,  ó|o, ọ|o, ô|o, ồ|o, ổ|o, ỗ|o, ố|o, ộ|o, ơ|o, ờ|o, ở|o, ỡ|o, ớ|o, ợ|o,  ù|u, ủ|u, ũ|u, ú|u, ụ|u, ư|u, ừ|u, ử|u, ữ|u, ứ|u, ự|u, ỳ|y, ỷ|y, ỹ|y,  ý|y, ỵ|y, À|a, Ả|a, Ã|a, Á|a, Ạ|a, Ă|a, Ằ|a, Ẳ|a, Ẵ|a, Ắ|a, Ặ|a, Â|a,  Ầ|a, Ẩ|a, Ẫ|a, Ấ|a, Ậ|a, Đ|d, È|e, Ẻ|e, Ẽ|e, É|e, Ẹ|e, Ê|e, Ề|e, Ể|e,  Ễ|e, Ế|e, Ệ|e, Ì|i, Ỉ|i, Ĩ|i, Í|i, Ị|i, Ò|o, Ỏ|o, Õ|o, Ó|o, Ọ|o, Ô|o,  Ồ|o, Ổ|o, Ỗ|o, Ố|o, Ộ|o, Ơ|o, Ờ|o, Ở|o, Ỡ|o, Ớ|o, Ợ|o, Ù|u, Ủ|u, Ũ|u,  Ú|u, Ụ|u, Ư|u, Ừ|u, Ử|u, Ữ|u, Ứ|u, Ự|u, Ỳ|y, Ỷ|y, Ỹ|y, Ý|y, Ỵ|y, "|,  &|';
	    $replacements = array();
	    $items = explode(',', $utf8characters);
	    foreach ($items as $item) {
	        @list($src, $dst) = explode('|', trim($item));
	        $replacements[trim($src)] = trim($dst);
	    }
	    $str = trim(strtr($str, $replacements));
	    $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);
	    $str = trim($str, '-');
	    return $str;
	}
	public function clean($string) {
       $string = str_replace(' ', '-', $string);
       $string = preg_replace('/[^A-Za-z0-9\-\.]/', '', $string);
       return preg_replace('/-+/', '-', $string);
    }
	public function cleanFileName($string)
	{
       return $this->replaceURL($this->clean($string));
	}
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
		$currentName = urldecode($currentName);
		$currentName = $this->cleanFileName($currentName);
		$fileName = $this->setFileName($pathAbsolute,$currentName,$extention).'.'.$extention;
		
		$curl = new \App\Crawl\CurlHelper;
		$res = $curl->exeCurl($linkCrawl);
		$pathMoveImg = $pathAbsolute.$fileName;
		if(empty($res['res'])) return '';
		file_put_contents($pathMoveImg, $res['res']);

		$imgId = Media::insertImageMedia($uploadRootDir, $pathAbsolute, $pathRelative, $fileName, $parentId);
		if (in_array(strtoupper($extention),['JPG','JPEG','PNG'])) {
			\DB::table('custom_media_images')->insert([
				'name' => $pathRelative.$fileName,
				'act' => 0,
				'created_at' => new \DateTime,
			]);
		}
		
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