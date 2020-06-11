<?php

namespace App\Http\Controllers;

use App\Article;
use App\Farmer;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\LogisticResource;
use App\PalletLabel;
use App\SortType;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LogisticResource
     */
    public function index(Request $request)
    {
        //
//        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
//
//        $champlanden = [1, 2, 3];
//
//        $articlesTotal = DB::select(DB::raw(
//            "SELECT article_id, SUM(article_amount) as article_amount from pallet_labels where farmer_id IN (" . implode(',', $champlanden) . ") AND status_id = 1 AND deleted_at IS NULL group by article_id"
//        ));
//
//        $palletlabelsTotal = DB::select(DB::raw(
//            "SELECT farmer_id, id, crop_date, article_amount, article_id FROM pallet_labels WHERE farmer_id IN (" . implode(',', $champlanden) . ") AND status_id = 1 AND deleted_at IS NULL"
//        ));
//
//        $palletlabelsCount = DB::select(DB::raw(
//            "SELECT COUNT(ID) as totalLabels FROM pallet_labels WHERE farmer_id IN (" . implode(',', $champlanden) . ") AND status_id = 1 AND deleted_at IS NULL"
//        ));
//
//        $totArr = [
//            "total_articles" => $articlesTotal,
//            "total_labels" => $palletlabelsTotal,
//            "total_labelsCount" => $palletlabelsCount
//        ];
//
//        return new LogisticResource($totArr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return LogisticResource
     */
    public function show(Request $request, $id)
    {
        //
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();

        $champlanden = [1, 2, 3];

        $articlesTotal = DB::select(DB::raw(
            "SELECT (SELECT CONCAT((select name from article_groups where id = articles.article_group_id), ' ', inset_limit, ' ', 'x', ' ', inset_gram, ' ', (select name from sort_types where id = articles.sort_type_id), ' ', (select color from insets where id = articles.inset_id), ' ', '(',  excel_code, ')') as article_name
              FROM articles
              WHERE id = pallet_labels.article_id) as article, SUM(article_amount) as article_amount from pallet_labels where farmer_id = '$id' AND status_id = 1 AND deleted_at IS NULL group by article_id"
        ));

//        $palletlabelsTotal = DB::select( DB::raw(
//            "SELECT (select distinct name from farmers where id = '$id') as farmer, id, crop_date, article_amount, article_id FROM pallet_labels WHERE farmer_id = '$id' AND status_id = 1"
//        ) );

        $palletlabelsTotal = DB::select(DB::raw(
            "SELECT (select distinct name from farmers where id = '$id') as farmer, id, crop_date, article_amount,
            (SELECT CONCAT((select name from article_groups where id = articles.article_group_id), ' ', inset_limit, ' ', 'x', ' ', inset_gram, ' ', (select name from sort_types where id = articles.sort_type_id), ' ', (select color from insets where id = articles.inset_id), ' ', '(',  excel_code, ')') as article_name
              FROM articles
              WHERE id = pallet_labels.article_id) as article
              FROM pallet_labels WHERE farmer_id = '$id' AND status_id = 1 AND deleted_at IS NULL"
        ));

        $palletlabelsCount = DB::select(DB::raw(
            "SELECT COUNT(ID) as totalLabels FROM pallet_labels WHERE farmer_id = '$id' AND status_id = 1 AND deleted_at IS NULL"
        ));

//        dd($palletlabelsCount['0']->totalLabels);

        if ($palletlabelsCount['0']->totalLabels === "0"){
            return [];
        }

        $totArr = [
            "total_articles" => $articlesTotal,
            "total_labels" => $palletlabelsTotal,
            "total_labelsCount" => $palletlabelsCount,
            "lastupdate" => date("d-m-Y h:i:s")
        ];

        return new LogisticResource($totArr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
