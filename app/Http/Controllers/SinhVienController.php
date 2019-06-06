<?php

namespace App\Http\Controllers;

use App\ChuyenNganh;
use App\CTHoc;
use App\KhoaHoc;
use App\SinhVien;
use App\MonHoc;
use App\BangDiem;
use Illuminate\Http\Request;
use Excel;
use DB;

class SinhVienController extends Controller
{
    /**
     * Update the specified resource in storage.
     * list totnghiep_status:
     *  0: studying
     *  1: considering_graduation
     *  2: graduated
     *  3: not_eligible_for_graduation
     *  4: orther
     */
    public function index(){
        $sinhvien=SinhVien::all();
        return view('sinhvien',compact('sinhvien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request){
        $this->validate($request,[
            'file'=>'required|mimes:xls,xlsx'
        ]);
        $path=$request->file('file')->getRealPath();

        $data=Excel::load($path)->get();
        foreach ($data->toArray() as $value){
            $sinhvien= new SinhVien();
            $sinhvien->masv=$value['masv'];
            $sinhvien->hoten=$value['hoten'];
            $sinhvien->ngaysinh=date('Y-m-d',strtotime($value['ngaysinh']));
            $sinhvien->lophoc=$value['lopcn'];
            $sinhvien->totnghiep_status=0;

            if (isset($value['khoa'])) {
                $khoahoc = KhoaHoc::select('id')->where('tenkhoa','=',$value['khoa'])->first();
                $sinhvien->kh_id= $khoahoc ? $khoahoc->id : 0;
            }
            if (isset($value['cn_hien_tai'])) {
                $chuyennganh = ChuyenNganh::select('id')->where('tencn','=',$value['cn_hien_tai'])->first();
                $sinhvien->cn_id= $chuyennganh ? $chuyennganh->id : 0;
            }
            $sinhvien->save();
        }
        return back();

    }
    public function create()
    {
        $khoa=KhoaHoc::all();
        $chuyennganh=ChuyenNganh::all();
        $monhoc=MonHoc::all();
        return view('sinhvien-add',compact('khoa','chuyennganh','monhoc'));
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
        $sinhvien->totnghiep_status=0;
        $sinhvien->save();
        //if ($request->check=="on"){
        //    if ($request->mh_id){
        //        foreach ($request->mh_id as $idmh){
        //            $so=rand(50,100)/10;
        //            $monhoc=MonHoc::find($idmh);
        //            $sinhvien->bangdiem()->attach($monhoc,array('diemtk'=>$so));
        //        }
        //    }
        //}else{
        //    if ($request->mh_id){
        //        foreach ($request->mh_id as $idmh){
        //            $so=rand(30,100)/10;
        //            if ($so >=4.6 && $so<5){
        //                $so= 5;
        //            }
        //            $monhoc=MonHoc::find($idmh);
        //            $sinhvien->bangdiem()->attach($monhoc,array('diemtk'=>$so));
        //        }
        //    }
        //}


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
        return view('sinhvien-edit',compact('sinhvien','khoa','chuyennganh','monhoc'));
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
            'lophoc'=>'required|max:100',
            'totnghiep_status'=>'min:0|max:5',

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
    public function destroy($id)
    {
        SinhVien::destroy($id);
        return response([
            'success'=>'Bạn đã delete thành công'
        ]);
    }

    public function getview($id){
        $sinhvien=SinhVien::find($id);
        $khoa=KhoaHoc::all();
        $chuyennganh=ChuyenNganh::all();
        $monhoc=MonHoc::all();
        return view('sinhvien-view',compact('sinhvien','khoa','chuyennganh','monhoc'));
    }


//    public function tracuusv(Request $request){
//        $sinhvien=SinhVien::where($request->column,'=',$request->tukhoa)->first();
//        if (empty($sinhvien)){
//            return 'Không tìm thấy sinh viên có mã này';
//        }else{
//            if ($sinhvien->bangdiem->isEmpty()){
//                $b=[];
//                $c=[];
//                return view('data-searchsv',compact('sinhvien','b','c'));
//            }else{
//                $a=$sinhvien->bangdiem->chunk(round(count($sinhvien->bangdiem)/2));
//                $b=$a[0];
//                $c=$a[1];
//                $tongtinchi=$sinhvien->bangdiem->where('pivot.diemtk','>=','5')->where('mamon','<>','GDQP')->where('mamon','<>','GDTC')->sum('sotinchi');
//                $diemtb=$sinhvien->bangdiem->where('mamon','<>','GDQP')->where('mamon','<>','GDTC')->sum('pivot.diemtk')/count($sinhvien->bangdiem);
//
//                return view('data-searchsv',compact('sinhvien','b','c','tongtinchi','diemtb'));
//            }
//
//        }
//
//
//    }
    public function getdiem(Request $request){
        $sinhvien=SinhVien::find($request->id);
        $bangdiem = BangDiem::all();
        //echo '<pre>';
        //var_dump($bangdiem);
        //exit();
        //$tongtinchi=$sinhvien->bangdiem->where('pivot.diemtk','>=','5')->where('mamon','<>','GDQP')->where('mamon','<>','GDTC')->sum('sotinchi');
        //$diemtb=$sinhvien->bangdiem->where('mamon','<>','GDQP')->where('mamon','<>','GDTC')->sum('pivot.diemtk')/count($sinhvien->bangdiem);
        return view('sinhvien-bangdiem',compact('sinhvien', 'bangdiem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * list totnghiep_status:
     *  0: studying
     *  1: considering_graduation
     *  2: graduated
     *  3: not_eligible_for_graduation
     *  4: orther
     */
    public function update_graduating_status(Request $request, $id)
    {
        $this->validate($request,[
            'graduating_status'=>'required|min:0|max:5',
        ]);
        $sinhvien=SinhVien::find($id);
        $sinhvien->graduating_status=$request->totnghiep_status;
        $sinhvien->save();
        return response([
            'success'=>'Bạn đã update thành công'
        ]);
    }
}
