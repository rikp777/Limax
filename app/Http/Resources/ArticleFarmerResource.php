<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleFarmerResource extends JsonResource
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
        return [
            'id' => $this->id,
            'excel_code' => $this->excel_code,
            'pallet_limit' => $this->pallet_limit,
            'name' => $this->fullName($this),
            'origin' => $this->origin,
            'inset_limit' => $this->inset_limit,
//            'relations' => [
//                'pallet_type_id' => $this->pallet_type_id,
//                'sort_type_id' => $this->sort_type_id,
//                'cask_id' => $this->cask_id,
//                'inset_id' => $this->inset_id,
//                'status_id' => $this->status_id,
//                'article_group_id' => $this->article_group_id,
//            ],


            'pallet_type' => $this->PalletType,
            'sort_type' => $this->sortType,
            'cask' => $this->cask,
            'inset' => $this->inset,
            'weight' => $this->inset_gram,
            'status' => $this->status,
            'article_group' => $this->articleGroup,
        ];
    }
}
