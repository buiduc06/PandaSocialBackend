<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class courseVideo extends Model
{
    protected $table = 'course_videos';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
