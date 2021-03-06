<?php

namespace App\Http\Controllers;

use App\BangDiem;
use App\ChuyenNganh;
use App\Http\Resources\BangDiem as BDResource;
use App\Khoa;
use App\MonHoc;
use App\SinhVien;
use Illuminate\Http\Request;
use Excel;
use DB;

class BangDiemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BDResource::collection(BangDiem::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $monhoc=MonHoc::all();
        $sinhvien=SinhVien::all();
        return view('bangdiem-add',compact('monhoc', 'sinhvien'));
    }


    public function import(Request $request){
        $this->validate($request,[
            'file'=>'required|mimes:xls,xlsx'
        ]);
        $path=$request->file('file')->getRealPath();

        $data=Excel::load($path)->get();
        foreach ($data->toArray() as $value){
            $bangdiem= new BangDiem();
            $bangdiem->id_sv= (SinhVien::select('id')->where('masv','=',$value['ma_sinh_vien'])->first())->id;
            $bangdiem->id_mh= (MonHoc::select('id')->where('mamon','=',$value['ma_hoc_phan'])->first())->id;
            $bangdiem->diemtk=$value['diem'];
            $bangdiem->save();
        }
        return back();

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bangdiem= new BangDiem();
        $bangdiem->id_sv= (SinhVien::select('id')->where('masv','=',$request['id_Sv'])->first())->id;
        $bangdiem->id_mh= (MonHoc::select('id')->where('mamon','=',$request['id_mh'])->first())->id;
        $bangdiem->diemtk=$request['diemtk'];
        $bangdiem->save();
        return response([
            'success'=>'Bạn đã update thành công'
        ]);
        return response([
            'success'=>'Bạn thêm mới thành công'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dkmonhoc',compact('cn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bangdiem=BangDiem::find($id);
        $monhoc=MonHoc::all();
        $sinhvien=SinhVien::all();
        return view('bangdiem-edit',compact('bangdiem','monhoc', 'sinhvien'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bangdiem= BangDiem::find($id);
        $bangdiem->id_sv= (SinhVien::select('id')->where('masv','=',$request['id_Sv'])->first())->id;
        $bangdiem->id_mh= (MonHoc::select('id')->where('mamon','=',$request['id_mh'])->first())->id;
        $bangdiem->diemtk=$request['diemtk'];
        $bangdiem->save();
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
        BangDiem::destroy($id);
        return response([
            'success'=>'Bạn đã delete thành công'
        ]);
    }
    public function getview(){
        return view('bangdiem');
    }
}
