<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{ImageGalleryCategory,ImageGallery};
class ImageGalleryController extends Controller
{	
    public function view($request, $route, $link){
        $currentItem = ImageGallery::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $parent = $currentItem->category()->act()->first();
        $imageRelateds = $currentItem->getRelatesCollection()->all();
        return view('image_gallery.view',compact('currentItem','parent','imageRelateds'));
    }
}