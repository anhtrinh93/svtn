<?php

namespace App\Http\Controllers;

use App\ChuyenNganh;
use App\CTHoc;
use App\Khoa;
use App\KhoaHoc;
use App\MonHoc;
use Illuminate\Http\Request;

class CTHocController extends Controller
{
    public function getview(){
        $cthoc=CTHoc::all();
        return view('cthoc',compact('cthoc'));
    }
    public function create(){
        $khoahoc=KhoaHoc::all();
        $chuyennganh=ChuyenNganh::all();
        $monhoc= MonHoc::all();

        return view('ctrinhhoc-add',compact('khoahoc','chuyennganh','monhoc'));
    }
    public function store(Request $request){
        foreach (CTHoc::all() as $a){
            if ($a->kh_id==$request->kh_id && $a->cn_id==$request->cn_id){
                return response([
                    'success'=>'Đã có QLQT khóa này rồi'
                ]);
            }
        }
        $mh_id=explode(',',$request->mh_id);
        $status=explode(',',$request->status);
        $mh_status=array_combine($mh_id,$status);
        $cthoc_mh=new CTHoc();
        $cthoc_mh->kh_id=$request->kh_id;
        $cthoc_mh->cn_id=$request->cn_id;
        $cthoc_mh->save();
        foreach ($mh_status as $key=>$value){

           $mh=MonHoc::find($key);
            $cthoc_mh->monhoc()->attach($mh,array('status'=>$value));

        }
        return response([
            'success'=>'Bạn đã tạo thành công'
        ]);
    }

    public function monhoc(Request $request){
        $cthoc=CTHoc::find($request->id);
        return view('cthoc-monhoc',compact('cthoc'));
    }
    public function edit($id){
        $cthoc=CTHoc::find($id);
        $khoahoc=KhoaHoc::all();
        $chuyennganh=ChuyenNganh::all();
        $monhoc= MonHoc::all();
        return view('cthoc-edit',compact('cthoc','khoahoc','chuyennganh','monhoc'));
    }
    public function update(Request $request,$id){

        $mh_st=array_combine($request->mh_id,$request->status);
        foreach ($mh_st as $key=>$value){
            $cthoc=CTHoc::find($id);
            $cthoc->monhoc()->updateExistingPivot($key, array('status'=>$value));

        }
        return response([
            'success'=>'Bạn đã update thành công'
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CTHoc::destroy($id);
        return response([
            'success'=>'Bạn update thành công'
        ]);
    }

}

