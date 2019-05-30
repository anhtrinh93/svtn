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
}
