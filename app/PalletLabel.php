<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PalletLabel extends Model
{
    use SoftDeletes;

    public function farmer(){
        return $this->belongsTo(Farmer::class);
    }
    public function palletType(){
        return $this->belongsTo(PalletType::class);
    }
    public function article(){
        return $this->belongsTo(Article::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
//    public function cultivationCycle(){
//        return $this->belongsTo(CultivationCycle::class);
//    }
    public function shippingLabels()
    {
        return $this->belongsToMany(ShippingLabel::class);
    }

    protected $hidden = [
        'deleted_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'crop_date' => 'date',
        'article_amount' => 'integer',
        'pallet_label_farmer_id' =>'integer',
        'cell_number' =>'integer',
        'cell_description'=>'string',
        'harvest_cycle'=>'integer',
        'harvest_cycle_day'=>'integer',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
        'cell_id'=>'integer',
        'user_id'=>'integer',
        'farmer_id'=>'integer',
        'cultivation_cycle_id'=>'integer',
        'pallet_type_id'=>'integer',
        'status_id'=>'integer',
        'article_id'=>'integer',
    ];
}
