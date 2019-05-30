<?php

namespace App\Http\Controllers;

use App\ChuyenNganh;
use App\Http\Resources\ChuyenNganh as CNResource;
use App\Khoa;
use Illuminate\Http\Request;

class ChuyenNganhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CNResource::collection(ChuyenNganh::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $khoa=Khoa::all();

        return view('chuyennganh-add',compact('khoa'));
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
            'macn'=>'required|min:2|max:10|unique:chuyennganh,macn',
            'tencn'=>'required|min:2|max:100|unique:chuyennganh,tencn'
        ]);
        $chuyennganh=new ChuyenNganh();
        $chuyennganh->macn=$request->macn;
        $chuyennganh->tencn=$request->tencn;
        $chuyennganh->khoa_id=$request->khoa_id;
        $chuyennganh->save();
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
        $cn=ChuyenNganh::find($id);
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
        $chuyennganh=ChuyenNganh::find($id);
        $khoa=Khoa::all();
        return view('chuyennganh-edit',compact('chuyennganh','khoa'));
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
            'macn'=>'required|min:2|max:10|unique:chuyennganh,macn,'.$id.',id',
            'tencn'=>'required|min:2|max:100|unique:chuyennganh,tencn,'.$id.',id',
        ]);
        $chuyennganh=ChuyenNganh::find($id);
        $chuyennganh->macn=$request->macn;
        $chuyennganh->tencn=$request->tencn;
        $chuyennganh->khoa_id=$request->khoa_id;
        $chuyennganh->save();
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
        ChuyenNganh::destroy($id);
        return response([
            'success'=>'Bạn đã delete thành công'
        ]);
    }
    public function getview(){
        return view('chuyennganh');
    }

}
