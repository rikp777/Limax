<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function palletType()
    {
        return $this->belongsTo(PalletType::class);
    }
    public function cask()
    {
        return $this->belongsTo(Cask::class);
    }
    public function inset()
    {
        return $this->belongsTo(Inset::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function articleGroup()
    {
        return $this->belongsTo(ArticleGroup::class);
    }
    public function sortType()
    {
        return $this->belongsTo(SortType::class);
    }
    public function palletLabels()
    {
        return $this->hasMany(PalletLabel::class);
    }
}
