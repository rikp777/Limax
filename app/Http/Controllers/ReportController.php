<?php

namespace App\Http\Controllers;

use App\Article;
use App\Farmer;
use App\Http\Resources\ReportResource;
use App\PalletLabel;
use App\SortType;
use App\Status;
use Illuminate\Http\Request;
use Request as CookieRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
//        dd('hoi');
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
        $article = article::all();
        $statuses = status::all();
        $palletlabels = PalletLabel::where('farmer_id', $currentFarmer->id)->where('crop_date', date('Y-m-d'))->get();
//        $palletlabels = PalletLabel::where('farmer_id', $currentFarmer->id)->get();
        $sorts = SortType::all();
//        dd($palletlabels);


//        $palletweight = 0;
        $reportLabels = [];
        $totpalletweight = 0;
        if (!sizeof($palletlabels)){
            return [];
        }
        foreach ($palletlabels as $pallet) {

            foreach ($statuses as $status){
                if($status["id"] === $pallet["status_id"]){
                    $statusdesc = $status["name"];
                }
            }



            $reportLabel = [
                "id" => $pallet['id'],
                "crop_date" => $pallet['crop_date'],
                "article_amount" => $pallet['article_amount'],
                "note" => $pallet['note'],
                "cell_number" => $pallet['cell_number'],
                "cell_description" => $pallet['cell_description'],
                "status_description" => $statusdesc,
//                "status_id" => 1
//                "article_id" => 1
                //weight
                //sort
                //statusdescpriton
            ];

            $articleid = $pallet["article_id"];
            $palletweight = 0;
            foreach ($article as $index => $art) {

                $artSortType = $art["sort_type_id"];
                foreach ($sorts as $sort) {

                    if ($articleid === $art["id"]) {
                        $sortid = $sort["id"];
                        if ($artSortType === $sortid) {
                            $indexes[] = $index;
                            $palletweight += ($art["inset_gram"] * $pallet["article_amount"]);
                            $totpalletweight += ($art["inset_gram"] * $pallet["article_amount"]);

                            $sortDesc = $sort["description"];
                            if (!isset($uniqueSort[$sortDesc])) {
                                $uniqueSort[$sortDesc] = 0;
                            }
                            $uniqueSort[$sortDesc] += round(($art["inset_gram"] * $pallet["article_amount"]) / 1000, 2);
                            $reportLabel["sort"] =  $sortDesc;
                        }

                    }

                }


            }
            $reportLabel["weight"] = round(($palletweight) / 1000, 2);
            $reportLabels[] = $reportLabel;



        }
//        dd($reportLabels);
//        dd($reportLabels);
        $totalpallets = sizeof($palletlabels);
        $avgpalletweight = round(($totpalletweight / sizeof($palletlabels)) / 1000, 2);
        $totalpalletweight = round(($totpalletweight) / 1000, 2);
        $sortChartArr = $uniqueSort;

//        $sortChartArr = [
//            "test" => 20,
//            "test2" => 20,
//            "test3" => 20,
//            "test4" => 20,
//            "test5" => 20,
//            "test6" => 20,
//            "test7" => 20,
//            "test8" => 20,
//            "test9" => 20,
//        ];

        $totArr = [
            "totalpallets" => $totalpallets,
            "avgpalletweight" => $avgpalletweight,
            "totalpalletweight" => $totalpalletweight,
            "sortchartarr" => $sortChartArr,
            "labels" => $reportLabels,
        ];

        return $totArr;

//        return ReportResource::collection(PalletLabel::where('farmer_id', $currentFarmer->id)->where('crop_date', '2020-01-22')->get());
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
