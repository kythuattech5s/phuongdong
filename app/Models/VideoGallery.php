<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class VideoGallery extends BaseModel
{
	use HasFactory;
    protected $table = 'video_gallery';
	public function category()
	{
		return $this->hasOne(VideoGalleryCategory::class, 'id', 'parent');
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
}