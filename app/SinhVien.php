<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table='sinhvien';
    protected $guarded=[];
    /**
     * Update the specified resource in storage.
     * list totnghiep_status:
     *  0: studying
     *  1: considering_graduation
     *  2: graduated
     *  3: not_eligible_for_graduation
     *  4: orther
     */
    public function get_list_status() {
        return  [
            0 => 'Đang học',
            1 => 'Yêu cầu xét tốt nghiệp',
            2 => 'Đã tốt nghiệp',
            3 => 'Không đủ điều kiện tốt nghiệp',
            4 => 'Khác'
        ];
    }

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
