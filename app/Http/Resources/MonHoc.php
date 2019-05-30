<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MonHoc extends Resource
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
            'mamon'=>$this->mamon,
            'tenmon'=>$this->tenmon,
            'tinchi'=>$this->tinchi,
            'heso'=>$this->heso
        ];
    }
}
