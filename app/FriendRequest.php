<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
	public $table ='friend_requests';
    protected $fillable = [
        'user_id', 'friend_id', 'status',
    ];

    

}
