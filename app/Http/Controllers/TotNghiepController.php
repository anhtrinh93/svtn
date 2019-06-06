<?php

namespace App\Http\Controllers;

use App\ChuyenNganh;
use App\KhoaHoc;
use App\SinhVien;
use App\MonHoc;
use Illuminate\Http\Request;
use Excel;
use DB;

class TotNghiepController extends Controller
{
    public function index(Request $request){
        $totnghiep_status = $request->input('status');
        if ($totnghiep_status == 'regist') {
            $condition = 1;
        } elseif ($totnghiep_status == 'success') {
            $condition = 2;
        }elseif ($totnghiep_status == 'cancel') {
            $condition = 3;
        }
        else {
            $condition = 0;
        }
        $sinhvien=SinhVien::where("totnghiep_status",'=',$condition)->get();

        return view('totnghiep',compact('sinhvien'));
    }
    public function create()
    {
        $sinhvien=SinhVien::all();
        return view('totnghiep-add',compact('sinhvien'));
    }
    public function getsinhvienview($id){
        $sinhvien=SinhVien::find($id);
        $khoa=KhoaHoc::all();
        $chuyennganh=ChuyenNganh::all();
        $monhoc=MonHoc::all();
        return view('totnghiep-sinhvien',compact('sinhvien','khoa','chuyennganh','monhoc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'masv'=>'required|min:4|max:10|unique:sinhvien,masv',
            'hoten'=>'required|min:5|max:100',
            'khoa_id'=>'required|max:100',
            'cn_id'=>'required|max:100',
            'ngaysinh'=>'required',
            'lophoc'=>'required|max:100'

        ]);
        $sinhvien=new SinhVien();
        $sinhvien->masv=$request->masv;
        $sinhvien->hoten=$request->hoten;
        $sinhvien->ngaysinh=$request->ngaysinh;
        $sinhvien->kh_id=$request->khoa_id;
        $sinhvien->cn_id=$request->cn_id;
        $sinhvien->lophoc=$request->lophoc;
        $sinhvien->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sinhvien=SinhVien::find($id);
        $khoa=KhoaHoc::all();
        $chuyennganh=ChuyenNganh::all();
        $monhoc=MonHoc::all();
        return view('totnghiep-edit',compact('sinhvien','khoa','chuyennganh','monhoc'));
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
        $this->validate($request,[
            'hoten'=>'required|min:5|max:100',
            'khoa_id'=>'required|max:100',
            'cn_id'=>'required|max:100',
            'ngaysinh'=>'required',
            'lophoc'=>'required|max:100'

        ]);
        $sinhvien=SinhVien::find($id);
        $sinhvien->masv=$request->masv;
        $sinhvien->hoten=$request->hoten;
        $sinhvien->ngaysinh=$request->ngaysinh;
        $sinhvien->kh_id=$request->khoa_id;
        $sinhvien->cn_id=$request->cn_id;
        $sinhvien->lophoc=$request->lophoc;
        $sinhvien->save();
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
    public function delete($id)
    {
        $sinhvien=SinhVien::find($id);
        $sinhvien->totnghiep_status=0;
        $sinhvien->save();
        return response([
            'success'=>'Bạn đã delete thành công'
        ]);
    }

    public function getview($id){
        $sinhvien=SinhVien::find($id);
        $khoa=KhoaHoc::all();
        $chuyennganh=ChuyenNganh::all();
        $monhoc=MonHoc::all();
        return view('totnghiep-view',compact('sinhvien','khoa','chuyennganh','monhoc'));
    }


}
