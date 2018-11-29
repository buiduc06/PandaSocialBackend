<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actionWithPost extends Model
{
    
    protected $fillable = [
        'awp_post_id', 'awp_like','awp_list_user_like' , 'awp_share', 'awp_comment',
    ];

    public function getUserIdByPost()
    {
        return PostMulti::find($this->awp_post_id)->pms_user_id;
    }
}
