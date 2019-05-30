<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BangDiem extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'hoten'=>$this->sinhvien->hoten,
            'tenmon'=>$this->monhoc->tenmon,
            'diemtk'=>$this->diemtk
        ];
    }
}
