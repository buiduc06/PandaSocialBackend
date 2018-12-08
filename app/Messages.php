<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public $table = 'messages';
    protected $fillable =[
        'user_id', 'friend_id', 'messages'];

    public function getFriendsInfo()
    {
        $dataUser = UserMetas::where('user_id', $this->friend_id)->first();
        return $dataUser->getAvatar();
    }
}
