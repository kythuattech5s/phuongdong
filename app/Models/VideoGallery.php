<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class VideoGallery extends BaseModel
{
	use HasFactory;
    protected $table = 'video_gallery';
	public function pivot(){
        return $this->hasMany('\App\Models\VideoGalleryVideoGalleryCategory', 'video_gallery_id', 'id');
    }
    
    public function category()
    {
        return $this->belongsToMany('App\Models\VideoGalleryCategory');
    }
    
    public function getRelates()
    {
        $category = $this->category()->act()->first();
        if ($category == null) {
            return null;
        }
        return $category->videoGallery();
    }
    public function getRelatesCollection(){
        $relate = $this->getRelates();
        return $relate?$relate->act()->ord()->take(5)->get():collect();
    }
    public function getPlayHtml(){
        return vsprintf('<iframe width="560" height="315" src="https://www.youtube.com/embed/%s" title="%s" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',[$this->video_info,$this->name]);
    }
}