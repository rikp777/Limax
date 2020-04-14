<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TruckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//                dd(parent::toArray($request));
//        $totarray["user"] = $this->truck()->with('user')->get();
        return [
            "id"=> $this->id,
            "license_plate" => $this->license_plate,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "status_id" => $this->status_id,
            "user_id" => $this->user_id,
//            "trucker" => new UserResource(User::find($this->user_id)),
            "trucker" => $this->user,
        ];
    }
}
