<?php
namespace App\Models;
use App\Models\BaseModel;
class Services extends BaseModel
{
	protected $table = 'services';
    public function pivot(){
    	return $this->hasMany('\App\Models\ServicesServiceCategory', 'services_id', 'id');
    }
    
    public function category()
    {
    	return $this->belongsToMany('App\Models\ServiceCategory','services_service_category', 'services_id','service_category_id');
    }
}
