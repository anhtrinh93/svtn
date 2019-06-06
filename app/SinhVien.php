<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table='sinhvien';
    protected $guarded=[];

    public function khoahoc(){
        return $this->belongsTo('App\KhoaHoc','kh_id','id');
    }
    public function chuyennganh(){
        return $this->belongsTo('App\ChuyenNganh','cn_id','id');
    }

    public function bangdiem(){
        return $this->belongsToMany('App\BangDiem','bangdiem','kh_cn_id','mh_id')->withPivot('id');
    }
}
