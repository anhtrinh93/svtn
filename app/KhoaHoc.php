<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    protected $table='khoahoc';
    protected $guarded=[];
    public function chuyennganh(){
        return $this->belongsToMany('App\ChuyenNganh','kh_cn','kh_id','cn_id')->withPivot('id');
    }
}
