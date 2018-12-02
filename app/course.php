<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use TraitMain;
    protected $table = 'courses';

    protected $fillable = [
        'title', 'description', 'summary', 'created_by', 'slug', 'status', 'category_id'
    ];


    public function video()
    {
        return $this->belongsToMany('App\video', 'course_videos');
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


    public static function boot() {
        parent::boot();

        static::deleting(function($model) { // before delete() method call this

            foreach ($model->video as $video) {
                $video->deleteVideoS3();
                $video->delete();
            }
            $model->coursevideo()->delete();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
