<?php

namespace App\Http\Resources;

use App\Article;
use App\Farmer;
use App\PalletType;
use App\Status;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PalletLabelResource extends JsonResource
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
//    public function toArray($request)
//    {
//        return [
//            'id' => $this->id,
//            'crop_date' => $this->crop_date,
//            'article_amount' => $this->article_amount,
//            'note' => $this->note,
//            'palletLabelFarmerId' => $this->pallet_label_farmer_id,
//            'harvestCycle' => $this->harvest_cycle,
//            'harvestCycleDay' => $this->harvest_cycle_day,
//            'userId' => $this->user_id,
//
//
////            'user' => new UserResource(User::find($this->user_id)),
////            'farmer' => New FarmerResource(Farmer::find($this->farmer_id)),
////            'cultivation_cycle' => new CultivationCycleResource(CultivationCycle::find($this->cultivation_cycle_id)),
////            'pallet_type' => new PalletTypeResource(PalletType::find($this->pallet_type_id)),
////            'status' => new StatusResource(Status::find($this->status_id)),
////            'article' => new ArticleResource(Article::find($this->article_id)),
//        ];
//    }

    public function with($request){
        return [
            'version' => '1.0.0',
        ];
    }
}