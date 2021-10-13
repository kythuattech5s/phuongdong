<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGalleryImageGalleryCategory extends Model
{
    use HasFactory;
    protected $table = 'image_gallery_image_gallery_category';
    public function imageGalleryCategory()
    {
    	return $this->belongsTo('App\Models\ImageGalleryCategory', 'image_gallery_category_id', 'id');
    }
}