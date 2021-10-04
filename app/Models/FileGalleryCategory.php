<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class FileGalleryCategory extends BaseModel
{
	use HasFactory;
	protected $table = 'file_gallery_categories';
	public function imageGallery()
	{
		return $this->hasMany('App\Models\FileGallery', 'parent', 'id');
	} 
}