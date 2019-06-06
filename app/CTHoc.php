<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CTHoc extends Model
{
    protected $table='kh_cn';
    protected $guarded=[];
    public function monhoc(){
        return $this->belongsToMany('App\MonHoc','kh_cn_mh','kh_cn_id','mh_id')->withPivot('status');
    }
    public function khoa(){
        return $this->belongsTo('App\KhoaHoc','kh_id','id');
    }
    public function chuyennganh(){
        return $this->belongsTo('App\ChuyenNganh','cn_id','id');
    }
}
