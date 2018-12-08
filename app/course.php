<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class course extends Model
{
    use TraitMain;
    protected $table = 'courses';

    protected $fillable = [
        'title', 'description', 'summary', 'created_by', 'slug', 'status', 'category_id', 'images'
    ];


    public function video()
    {
        return $this->belongsToMany('App\video', 'course_videos');
    }

    public function commentVideos()
    {
        return $this->hasMany('App\CommentVideo', 'course_id', 'id');
    }

    public function coursevideo()
    {
        return $this->hasMany('App\courseVideo', 'course_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\category');
    }

    public function adminUser()
    {
        return $this->belongsTo('App\AdminUser', 'created_by', 'id');
    }

    public function getImg()
    {
        if ($this->images) {
            return url('/uploads/'.$this->images);
        }
        return url('/images/default.png');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
 // before delete() method call this

            foreach ($model->video as $video) {
                $video->deleteVideoS3();
                $video->delete();
            }
            $model->coursevideo()->delete();
        });

        static::addGlobalScope(function ($query) {

            if (!Auth::guard('admin')->check()) {
                 return $query->where('courses.status', '!=', 0);
            }
        });
    }



    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getLinkCourse($video_id = '')
    {
        if ($video_id) {
            return route('customer.course', ['slug'=>$this->slug, 'id'=>$this->id, 'video_id'=>$video_id]);
        }
        return route('customer.course', ['slug'=>$this->slug, 'id'=>$this->id]);
    }

  

    public function getCountComment()
    {
        return 0;
    }
}
