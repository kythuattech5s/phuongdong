<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ImageGalleryCategory extends BaseModel
{
	use HasFactory;
	protected $table = 'image_gallery_categories';
	public function imageGallery()
	{
		return $this->hasMany('App\Models\ImageGallery', 'parent', 'id');
	} 
}