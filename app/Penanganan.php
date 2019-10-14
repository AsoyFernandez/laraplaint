<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penanganan extends Model
{
    protected $guarded = [];
    
    public function pengaduan(){
    	return $this->hasOne('App\Pengaduan');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function riwayats(){
    	return $this->hasMany('App\Riwayat');
    }
}
