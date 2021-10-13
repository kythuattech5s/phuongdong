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
		return $this->belongsToMany('App\Models\VideoGallery', 'video_gallery_video_gallery_category', 'video_gallery_category_id', 'video_gallery_id');
	}
}