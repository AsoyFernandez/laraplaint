<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $guarded = [];
    
    public function penanganan(){
    	return $this->belongsTo('App\Penanganan');
    }
}
