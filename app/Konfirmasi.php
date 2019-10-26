<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    protected $guarded = [];

    public function pengaduan(){
    	return $this->belongsTo('App\Pengaduan');
    }

	public function user(){
    	return $this->belongsTo('App\User');
    }    
}
