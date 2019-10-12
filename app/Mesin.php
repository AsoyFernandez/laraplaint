<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    protected $guarded = [];

    public function kategori(){
    	return $this->belongsTo('App\Kategori');
    }
}
