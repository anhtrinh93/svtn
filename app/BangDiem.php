<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BangDiem extends Model
{
    protected $table='bangdiem';
    protected $guarded=[];
    public function monhoc(){
        return $this->belongsTo('App\MonHoc','id_mh','id');
    }
    public function sinhvien(){
        return $this->belongsTo('App\SinhVien','id_sv','id');
    }
}
