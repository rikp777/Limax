<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerResource extends JsonResource
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
            'uid' => $this->uid,
            'name' => $this->name,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'place' => $this->place,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'province' => $this->province,
            'email' => $this->email,
            'phone' => $this->phone,
            'fax' => $this->fax,
            'preference_article_group_id' => $this->preference_article_group_id,
            'contact_person_user_id' => $this->contact_person_user_id,
            'certificates' => $this->certificateFarmerCode()->with('certificate')->get(),
        ];
    }
}
