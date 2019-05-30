<?php

namespace App\Http\Controllers;

use App\ChuyenNganh;
use App\KH_CN;
use App\KhoaHoc;
use App\MonHoc;
use Illuminate\Http\Request;

class CTHocController extends Controller
{
    public function getview(){
        $kh_cn=KH_CN::all();
        return view('cthoc',compact('kh_cn'));
    }
    public function create(){
        $khoahoc=KhoaHoc::all();
        $chuyennganh=ChuyenNganh::all();
        $monhoc= MonHoc::all();
        return view('ctrinhhoc-add',compact('khoahoc','chuyennganh','monhoc'));
    }
    public function store(Request $request){
        foreach (KH_CN::all() as $a){
            if ($a->kh_id==$request->kh_id && $a->cn_id==$request->cn_id){
                return response([
                    'success'=>'Đã có QLQT khóa này rồi'
                ]);
            }
        }
        $mh_id=explode(',',$request->mh_id);
        $status=explode(',',$request->status);
        $mh_status=array_combine($mh_id,$status);
        $kh_cn_mh=new KH_CN();
        $kh_cn_mh->kh_id=$request->kh_id;
        $kh_cn_mh->cn_id=$request->cn_id;
        $kh_cn_mh->save();
        foreach ($mh_status as $key=>$value){

           $mh=MonHoc::find($key);
            $kh_cn_mh->monhoc()->attach($mh,array('status'=>$value));

        }
        return response([
            'success'=>'Bạn đã tạo thành công'
        ]);
    }

    public function monhoc(Request $request){
        $kh_cn=KH_CN::find($request->id);
        return view('cthoc-monhoc',compact('kh_cn'));
    }
    public function edit($id){
        $kh_cn=KH_CN::find($id);
        return view('cthoc-edit',compact('kh_cn'));
    }
    public function update(Request $request,$id){

        $mh_st=array_combine($request->mh_id,$request->status);
        foreach ($mh_st as $key=>$value){
            $kh_cn=KH_CN::find($id);
            $kh_cn->monhoc()->updateExistingPivot($key, array('status'=>$value));

        }
        return response([
            'success'=>'Bạn đã update thành công'
        ]);
    }

}

