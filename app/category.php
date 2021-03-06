<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class category extends Model
{
    use TraitMain;
    protected $table = 'categories';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function course()
    {
        return $this->hasMany('App\course', 'category_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {

            if (!Auth::guard('admin')->check()) {
                 return $query->where('categories.status', '!=', 0);
            }
        });
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


    public function scopeParents($query)
    {
        return $query->where('parent_id', 0);
    }

    public function dashbroandCount()
    {
        return $this::Active()->select('id')->count();
    }
}
