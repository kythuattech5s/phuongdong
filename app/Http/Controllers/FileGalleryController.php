<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{FileGalleryCategory,FileGallery};
class FileGalleryController extends Controller
{	
    public function view($request, $route, $link){
        $currentItem = FileGallery::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $parent = $currentItem->category()->act()->first();
        $fileRelateds = $currentItem->getRelatesCollection()->all();
        return view('file_gallery.view',compact('currentItem','parent','fileRelateds'));
    }
}