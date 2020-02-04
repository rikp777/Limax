<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TruckerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        dd($this);
//        return [
//            "user" => $this->user,
//        ];
    }
}
