<?php

namespace App\Http\Controllers;

use App\Article;
use App\Farmer;
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
//        dd("logisticsindex");
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
//        $palletlabels = PalletLabel::where('farmer_id', $currentFarmer->id)->get();

        $champlanden = [1,2,3];

        $articlesTotal = DB::select( DB::raw(
            "SELECT article_id, SUM(article_amount) as article_amount from pallet_labels where farmer_id IN (".implode(',',$champlanden).") AND status_id = 1 group by article_id"
        ) );

        $palletlabelsTotal = DB::select( DB::raw(
            "SELECT farmer_id, id, crop_date, article_amount, article_id FROM pallet_labels WHERE farmer_id IN (".implode(',',$champlanden).") AND status_id = 1"
        ) );

        $palletlabelsCount = DB::select( DB::raw(
            "SELECT COUNT(ID) as totalLabels FROM pallet_labels WHERE farmer_id IN (".implode(',',$champlanden).") AND status_id = 1"
        ) );

//        $totalArr = [];
//
//        foreach ($palletlabelsTotal as $palletlabel){
//            if (!isset($totalArr[$palletlabel->article_id])) {
//                $totalArr[$palletlabel->article_id] = 0;
//            }
//            $totalArr[$palletlabel->article_id] += $palletlabel->article_amount;
//        }

        $totArr = [
            "total_articles" => $articlesTotal,
            "total_labels" => $palletlabelsTotal,
            "total_labelsCount" => $palletlabelsCount
        ];

        return new LogisticResource($totArr);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
//        dd("logisticsshow");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
