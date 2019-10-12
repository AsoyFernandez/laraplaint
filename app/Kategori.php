<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = [];

    public function mesins(){
    	return $this->hasMany('App\Mesin');
    }
}
