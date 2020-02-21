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
            'pallet_limit' => $this->pallet_limit,
            'name' => $this->fullName($this),
            'origin' => $this->origin,
            'inset_limit' => $this->inset_limit,
            'pallet_type' => $this->PalletType,
            'sort_type' => $this->sortType,
            'cask' => $this->cask,
            'inset' => $this->inset,
            'weight' => $this->inset_gram,
            'status' => $this->status,
            'article_group' => $this->articleGroup,
        ];
    }

    public function with($request){
        return [
            'version' => '1.0.0',
        ];
    }
}
