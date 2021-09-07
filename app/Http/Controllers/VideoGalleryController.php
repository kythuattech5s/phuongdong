<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{VideoGalleryCategory,VideoGallery};
class VideoGalleryController extends Controller
{   
    public function view($request, $route, $link){
        $currentItem = VideoGallery::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $parent = $currentItem->category()->act()->first();
        $videoRelateds = $currentItem->getRelatesCollection()->all();
        return view('video_gallery.view',compact('currentItem','parent','videoRelateds'));
    }
}