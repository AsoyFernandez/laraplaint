<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    protected $guarded = [];

    public function pengaduan(){
    	return $this->hasOne('App\Pengaduan');
    }
}
