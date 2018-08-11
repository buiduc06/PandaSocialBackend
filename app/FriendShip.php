<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendShip extends Model
{
public $table = 'friend_ships';
   public $timestamps = false;
   protected $fillable = [
        'user_id', 'friend_id', 'status',
    ];
}
