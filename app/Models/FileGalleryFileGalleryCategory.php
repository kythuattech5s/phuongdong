<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileGalleryFileGalleryCategory extends Model
{
    use HasFactory;
    protected $table = 'file_gallery_file_gallery_category';
    public function fileGalleryCategory()
    {
    	return $this->belongsTo('App\Models\FileGalleryCategory', 'file_gallery_category_id', 'id');
    }
}