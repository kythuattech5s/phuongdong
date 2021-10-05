<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGalleryVideoGalleryCategory extends Model
{
    use HasFactory;
    protected $table = 'video_gallery_video_gallery_category';
    public function videoGalleryCategory()
    {
    	return $this->belongsTo('App\Models\VideoGalleryCategory', 'video_gallery_category_id', 'id');
    }
}