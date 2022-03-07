<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function medicines()
    {
        // tabel yang dituju, foreignkey, primarykey
        return $this->hasMany('App\Medicine','category_id','id');
    }
}
