<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class FileGalleryCategory extends BaseModel
{
	use HasFactory;
	protected $table = 'file_gallery_categories';
	public function fileGallery()
	{
		return $this->belongsToMany('App\Models\FileGallery', 'file_gallery_file_gallery_category', 'file_gallery_category_id', 'file_gallery_id');
	} 
}