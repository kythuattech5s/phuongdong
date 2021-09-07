<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class VideoGalleryCategory extends BaseModel
{
	use HasFactory;
	protected $table = 'video_gallery_categories';
	public function videoGallery()
	{
		return $this->hasMany('App\Models\VideoGallery', 'parent', 'id');
	} 
}