<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
class Doctor extends BaseModel
{
	use HasFactory;
	public function getSpecialist()
	{
		return Specialist::find($this->specialist_id);
	}
}