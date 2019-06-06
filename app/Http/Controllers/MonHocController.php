<?php

namespace App\Http\Controllers;

use App\MonHoc;
use Illuminate\Http\Request;
use Excel;
use DB;
class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data'=>MonHoc::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('monhoc-add');
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
            'mamon'=>'required|min:2|max:10|unique:monhoc,mamon',
            'tenmon'=>'required|min:2|max:100|unique:monhoc,tenmon',
            'tinchi'=>'required|numeric',
            'heso'=>'required|numeric',

        ]);
        $monhoc=new MonHoc();
        $monhoc->mamon=$request->mamon;
        $monhoc->tenmon=$request->tenmon;
        $monhoc->tinchi=$request->tinchi;
        $monhoc->heso=$request->heso;
        $monhoc->save();

        return response([
            'success'=>'Bạn thêm mới thành công'
        ]);

    }

    public function import(Request $request){
        $this->validate($request,[
            'file'=>'required|mimes:xls,xlsx'
        ]);
        $path=$request->file('file')->getRealPath();

        $data=Excel::load($path)->get();
        foreach ($data->toArray() as $value){
            $monhoc= new MonHoc();
            $monhoc->mamon=$value['ma_hoc_phan'];
            $monhoc->tenmon=$value['ten_hoc_phan'];
            $monhoc->tinchi=$value['so_tin_chi'];
            $monhoc->heso=$value['he_so'];
            $monhoc->save();
        }
        return back();
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
        $monhoc=MonHoc::find($id);


        return view('monhoc-edit',compact('monhoc'));
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
            'mamon'=>'required|min:2|max:10|unique:monhoc,mamon,'.$id.',id',
            'tenmon'=>'required|min:2|max:100|unique:monhoc,tenmon,'.$id.',id',
            'tinchi'=>'required|numeric',
            'heso'=>'required|numeric',
        ]);
        $monhoc=MonHoc::find($id);
        $monhoc->mamon=$request->mamon;
        $monhoc->tenmon=$request->tenmon;
        $monhoc->tinchi=$request->tinchi;
        $monhoc->heso=$request->heso;
        $monhoc->save();
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
        MonHoc::destroy($id);
        return response([
            'success'=>'Bạn đã delete thành công'
        ]);
    }
    public function getview(){
        return view('monhoc');
    }
}
