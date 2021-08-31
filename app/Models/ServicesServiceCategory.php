<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ServicesServiceCategory extends Model
{
    use HasFactory;
    protected $table = 'services_service_category';
    public function serviceCategory()
    {
    	return $this->belongsTo('App\Models\ServiceCategory', 'service_category_id', 'id');
    }
}
