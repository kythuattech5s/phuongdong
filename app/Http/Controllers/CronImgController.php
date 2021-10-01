<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WebPConvert\WebPConvert;
class CronImgController extends Controller
{
    public function convertImg(Request $request){
        set_time_limit(0);
        $hLock=fopen("cronimg.lock", "w+");
        if(!flock($hLock, LOCK_EX | LOCK_NB)){
            die("Already running. Exiting...");
        }
        $imgs = \DB::table('custom_media_images')->where('act', 0)->take(10)->get();
        foreach ($imgs as $key => $item) {
            $fileName = substr($item->name, strrpos($item->name, '/') + 1, strlen($item->name));
            $baseName = substr($fileName, 0, strrpos($fileName, '.'));
            $fileExtension = strtolower(substr($fileName, strrpos($fileName, '.') + 1));
            $pathMove = substr($item->name, 0, strrpos($item->name, '/'));
            $pathMove = base_path($pathMove.'/');
            $status = 1;
            if (file_exists($pathMove) && file_exists(base_path($item->name)) && in_array($fileExtension,['jpg','jpeg','png'])) {
                try {
                    WebPConvert::convert(base_path($item->name), $pathMove.$baseName.'.webp', []);
                    $arrSizes = @$this->getSizes($pathMove.$fileName);
                    if(count($arrSizes) > 0){
                        foreach ($arrSizes as $size) {
                            $new_image = $this->resizeImage($pathMove,$baseName,$fileName,$size["width"],$size["height"],$size["quality"],$size["name"]);
                        }
                    } 
                } catch (\Exception $e) {
                    $status = 2;
                }
            }
            \DB::table('custom_media_images')->where('id', $item->id)->update(['act' => $status]);
        }
        flock($hLock, LOCK_UN);
        fclose($hLock);
        unlink('cronimg.lock');
    }
    private function getSizes($file){
        if(file_exists($file)){
            $sizes = \DB::table("v_configs")->select("value")->where("name","SIZE_IMAGE")->get();
            
            if($sizes!=null && count($sizes)>0){
                $json = $sizes[0]->value;
                $arr = json_decode($json,true);
                $arr = @$arr?$arr:array();
                $s = getimagesize($file);
                $w = count($s)>0?$s[0]:1;
                $h = count($s)>1?$s[1]:1;
                array_push($arr,array("name"=>"def","width"=>100,"height"=>(int)($h*100/$w),"quality"=>80));
                return $arr;
            }
        }
        return array();
    }
    private function resizeImage($upload_path,$baseName,$filename,$widthImage,$heightImage,$quality,$name){
        $img = \Image::make($upload_path.$filename);
        if($heightImage<=0){
            $img->resize($widthImage, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        else if($widthImage<=0){
            $img->resize(null, $heightImage, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        else{
            $img->resize($widthImage, $heightImage);
        }
        $newpath = $upload_path."thumbs/".$name."/";
        if(!is_dir($newpath)){
            mkdir($newpath,0777,1);
        }
        $img->save($newpath.$filename, $quality);
        /*convert image to webp*/
        WebPConvert::convert($newpath.$filename, $newpath.$baseName.'.webp', []);
        return $newpath.$filename;
    }
}
