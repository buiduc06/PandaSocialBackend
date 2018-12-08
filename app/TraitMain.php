<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait TraitMain
{
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function dashbroandCount()
    {
        return $this::Active()->select('id')->count();
    }
    public function getDatePublic()
    {
        return $this->created_at->format('d-M-Y');
    }
}
