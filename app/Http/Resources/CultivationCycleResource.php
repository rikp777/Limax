<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CultivationCycleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request){
        return [
            'version' => '1.0.0',
        ];
    }
}
