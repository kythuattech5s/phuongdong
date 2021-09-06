<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ImageGallery extends BaseModel
{
	use HasFactory;
    protected $table = 'image_gallery';
	public function category()
	{
		return $this->hasOne(ImageGalleryCategory::class, 'id', 'parent');
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