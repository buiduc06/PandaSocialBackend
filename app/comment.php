<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\UserResource;
class comment extends Model
{
	protected $fillable = [
		'cm_user_id', 'cm_post_id', 'cm_content', 'cm_image'
	];

	public function getUserComment()
	{
		$data = User::find($this->cm_user_id);
		if($data){
			return new UserResource($data);
		}
		return null;

	}
}
