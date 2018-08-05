<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    protected $fillable =[
    	'user_id', 'post_id', 'image', 'type', 'status'
    ];

    public function getImg()
    {
    	return url('uploads/'.$this->image);
    }
}
