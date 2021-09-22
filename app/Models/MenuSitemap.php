<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class MenuSitemap extends BaseModel
{
	use HasFactory;
	public function childs()
	   {
	    return $this->hasMany('App\Models\MenuSitemap', 'parent', 'id');
    }
    public function recursiveChilds()
    {
    	return $this->childs()->act()->ord()->with('recursiveChilds');
    }
}