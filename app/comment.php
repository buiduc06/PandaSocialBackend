<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\UserResource;
use Tymon\JWTAuth\Facades\JWTAuth;
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
	public function isMyComment()
	{
		$user = JWTAuth::parseToken()->authenticate();
		if ($this->cm_user_id == $user['id']) {
			return 'true';
		}
		return 'false';
	}
public function getDateComment()
{
	return $this->created_at->format('H:s');
}
	 
}
