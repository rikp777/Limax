<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'id' => $this->id,
            'excel_code' => $this->excel_code,
            'pallet_limit' => $this->pallet_limmit,
            'name' => $this->fullName($this),
        ];
    }

    public function with($request){
        return [
            'version' => '1.0.0',
        ];
    }
}
