<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ImageGallery extends BaseModel
{
	use HasFactory;
    protected $table = 'image_gallery';
	public function pivot(){
        return $this->hasMany('\App\Models\ImageGalleryImageGalleryCategory', 'image_gallery_id', 'id');
    }
    
    public function category()
    {
        return $this->belongsToMany('App\Models\ImageGalleryCategory');
    }
    
    public function getRelates()
    {
        $category = $this->category()->act()->first();
        if ($category == null) {
            return null;
        }
        return $category->imageGallery();
    }
    public function getRelatesCollection(){
        $relate = $this->getRelates();
        return $relate?$relate->act()->ord()->take(5)->get():collect();
    }
}