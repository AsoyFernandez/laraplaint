<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $guarded = [];

    public function mesin(){
    	return $this->belongsTo('App\Mesin');
    }

    public function lokasi(){
    	return $this->belongsTo('App\Lokasi');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function penanganan(){
        return $this->hasOne('App\Penanganan');
    }

    public function konfirmasi(){
        return $this->belongsTo('App\Konfirmasi');
    }
}
