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

    public static function fullName($article){
        return
            $article->articleGroup->name . ' ' .
            $article->inset_limit . 'x' .
            $article->inset_gram . ' ' .
            $article->sortType->name . ' ' .
            $article->inset->color . ' (' .
            $article->excel_code . ')';
    }

    protected $fillable = [
        'excel_code',
        'inset_gram',
        'inset_limit',
        'pallet_limit',
        'origin',
        'pallet_type_id',
        'cask_id',
        'inset_id',
        'status_id',
        'article_group_id',
        'sort_type_id',
    ];
}
