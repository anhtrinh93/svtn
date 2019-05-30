<?php

namespace App\Http\Controllers;

use App\ChuyenNganh;
use App\KH_CN;
use App\KhoaHoc;
use App\MonHoc;
use Illuminate\Http\Request;

class KhoaHocController extends Controller
{
    public function index()
    {
        return response([
            'data'=>KhoaHoc::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chuyennganh=ChuyenNganh::all();
        return view('khoahoc-add',compact('chuyennganh'));
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
            'tenkhoa' => 'required|unique:khoahoc,tenkhoa|min:3|max:100'
        ]);
        $khoahoc=new KhoaHoc();
        $khoahoc->tenkhoa=$request->tenkhoa;
        $khoahoc->save();

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

        $khoahoc=KhoaHoc::find($id);
        return view('khoahoc-edit',compact('khoahoc'));
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
            'tenkhoa' => 'required|unique:khoahoc,tenkhoa,'.$id.',id|min:3|max:100'
        ]);
        $khoahoc=KhoaHoc::find($id);
        $khoahoc->tenkhoa=$request->tenkhoa;

        $khoahoc->save();
        return response([
            'success'=>'Bạn update thành công'
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
        KhoaHoc::destroy($id);
        return response([
            'success'=>'Bạn update thành công'
        ]);
    }
    public function getview(){
        return view('khoahoc');
    }
    public function viewctrinhhoc($id){
        $khoahoc=KhoaHoc::find($id);
        $monhoc=MonHoc::all();
        return view('ctrinhhoc',compact('khoahoc','monhoc'));
    }
    public function monhoc(Request $request){
        $kh_cn=KH_CN::find($request->id);

        return $kh_cn;
    }
}
