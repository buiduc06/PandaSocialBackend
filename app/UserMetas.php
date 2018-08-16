<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMetas extends Model
{
	protected $fillable = [
		'user_id', 'firstname', 'lastname', 'phone', 'country', 'province', 'city', 'description', 'gender', 'website', 'avatar', 'banner'
	];

	public function getAvatar()
	{
		if (!empty($this->avatar)) {
			return url('uploads/'.$this->avatar);
		}
		return url('images/default.png');

	}
	

}
