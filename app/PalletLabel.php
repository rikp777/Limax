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
}
