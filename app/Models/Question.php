<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Question extends BaseModel
{
	use HasFactory;
	public function category()
	{
		return $this->hasOne(QuestionCategory::class, 'id', 'parent');
	}
	public function getRelates()
    {
        $category = $this->category()->act()->first();
        if ($category == null) {
            return null;
        }
        return $category->question();
    }
    public function getRelatesCollection(){
        $relate = $this->getRelates();
        return $relate?$relate->act()->ord()->take(5)->get():collect();
    }
}