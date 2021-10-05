<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class FileGallery extends BaseModel
{
	use HasFactory;
    protected $table = 'file_gallery';
	public function pivot(){
        return $this->hasMany('\App\Models\FileGalleryFileGalleryCategory', 'file_gallery_id', 'id');
    }
    
    public function category()
    {
        return $this->belongsToMany('App\Models\FileGalleryCategory');
    }
    
    public function getRelates()
    {
        $category = $this->category()->act()->first();
        if ($category == null) {
            return null;
        }
        return $category->fileGallery();
    }
    public function getRelatesCollection(){
        $relate = $this->getRelates();
        return $relate?$relate->act()->ord()->take(5)->get():collect();
    }
}