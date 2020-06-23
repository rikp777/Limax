<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farmer extends Model
{
    use SoftDeletes;

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function sort_types()
    {
        return $this->belongsToMany(SortType::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function cells()
    {
        return $this->hasMany(Cell::class);
    }
//    public function cultivationCycles()
//    {
//        return $this->hasMany(CultivationCycle::class);
//    }
    public function palletlabels()
    {
        return $this->hasMany(PalletLabel::class);
    }
    public function certificateFarmerCode()
    {
        return $this->hasMany(CertificateFarmerCode::class);
    }

//ctrlfFARMERID change farmer id to route
    public static function getCurrentFarmer(){
        return Farmer::find(1);
    }
//ctrlfFARMERID change farmer id to route
    public static function getCurrentFarmerId(){
        return Farmer::find(1)->id;
    }

    protected $casts = [
        'id' => 'integer',
        'uid' => 'string',
        'name' => 'string',
        'street' => 'string',
        'house_number' => 'string',
        'place' => 'string',
        'zip_code' => 'string',
        'country' => 'string',
        'province' => 'string',
        'email' => 'string',
        'phone' => 'integer',
        'fax' => 'integer',
        'created_at' =>'datetime',
        'updated_at'=>'datetime',
        'deleted_at'=>'datetime',
        'preference_article_group_id'=>'integer',
        'contact_person_user_id'=>'integer',
    ];

}
