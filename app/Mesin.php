<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    protected $guarded = [];

    public function kategori(){
    	return $this->belongsTo('App\Kategori');
    }

    public function pengaduans(){
    	return $this->hasMany('App\Pengaduan');
    }

    public function lokasis(){
    	return $this->belongsToMany('App\Lokasi');
    }
}
