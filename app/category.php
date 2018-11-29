<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function course()
    {
        return $this->hasMany('App\course', 'category_id', 'id');
    }

    public function getParent()
    {
        if ($this->parent_id > 0) {
            if ($data = self::find($this->parent_id)) {
                return $data->name;
            }
            return 'trống';
        }
        return 'trống';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
