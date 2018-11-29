<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use TraitMain;
    protected $table = 'videos';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
