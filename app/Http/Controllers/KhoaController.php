<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Khoa;
use App\Http\Resources\Khoa as KhoaResource;

class KhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return KhoaResource::collection(Khoa::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('khoa-add');
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
            'tenkhoa' => 'required|unique:khoa,tenkhoa|min:3|max:100'
        ]);
        $khoa=new Khoa();
        $khoa->tenkhoa=$request->tenkhoa;
        $khoa->save();
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

        $khoa=Khoa::find($id);
        return view('khoa-edit',compact('khoa'));
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
            'tenkhoa' => 'required|unique:khoa,tenkhoa,'.$id.',id|min:3|max:100'
        ]);
        $khoa=Khoa::find($id);
        $khoa->tenkhoa=$request->tenkhoa;

        $khoa->save();
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
        Khoa::destroy($id);
        return response([
            'success'=>'Bạn update thành công'
        ]);
    }
    public function getview(){
        return view('khoa');
    }
}
