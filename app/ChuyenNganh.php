<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    protected $table='chuyennganh';
    protected $guarded=[];
    public function khoa(){
        return $this->belongsTo('App\Khoa','khoa_id','id');
    }
}
