<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use TraitMain;
    protected $table = 'courses';

    protected $fillable = [
        'title', 'description', 'summary', 'created_by', 'slug', 'status'
    ];


    public function video()
    {
        return $this->belongsToMany('App\video', 'course_videos');
    }

    public function category()
    {
        return $this->belongsTo('App\category');
    }

    public function adminUser()
    {
        return $this->belongsTo('App\AdminUser', 'created_by', 'id');
    }


    // scope

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
