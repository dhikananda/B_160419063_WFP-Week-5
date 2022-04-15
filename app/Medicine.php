<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    // bisa melihat kategori sesuai dengan kolom category_id
    public function category()
    {
        // mereturn sebuah model kategory, foreignkeynya
        return $this->belongsTo('App\Category','category_id');
    }

    public function transaction(){
        return $this->belongsToMany('App\Transaction','medicine_transaction','medicine_id','transaction_id')
        ->withPivot('quantity','price');
    }
}
