<?php

namespace App\Http\Controllers;

use App\Article;
use App\Farmer;
use App\Http\Resources\LogisticResource;
use App\Http\Resources\ReportResource;
use App\PalletLabel;
use App\SortType;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $id = Farmer::where('uid', $request->header('authFarmer'))->first();

        $palletlabelsTotal = DB::select(DB::raw(
            "SELECT id, pallet_label_farmer_id, crop_date, article_amount, (select name from sort_types where id = (select sort_type_id from articles where id = pallet_labels.article_id)) as sort, (select cast((((select inset_gram from articles where id = pallet_labels.article_id) * (select inset_limit from articles where id = pallet_labels.article_id)) * article_amount) / 1000 as numeric(36,2)) from articles where articles.id = pallet_labels.article_id) as weight, note, (select name from statuses where id = pallet_labels.status_id) as status, (SELECT description from cells where id = pallet_labels.cell_id) as cell FROM pallet_labels WHERE farmer_id = '$id->id' AND created_at  >= DATEADD(DAY, 0, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND created_at <  DATEADD(DAY, 1, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND deleted_at IS NULL"
        ));

        $sortsTotal = DB::select(DB::raw(
            "SELECT p.sort, SUM(p.weight) as weight from (
SELECT sort,
(select b.weight from (select (select cast((((select inset_gram from articles where id = pallet_labels.article_id) * (select inset_limit from articles where id = pallet_labels.article_id)) * article_amount) / 1000 as numeric(36,2)) from articles where articles.id = pallet_labels.article_id) as weight) b) as weight
from pallet_labels
JOIN articles ON articles.id = pallet_labels.article_id
CROSS APPLY (SELECT name as sort from sort_types where id = (select sort_type_id from articles where id = pallet_labels.article_id)) Alias
WHERE farmer_id = '$id->id' AND pallet_labels.created_at  >= DATEADD(DAY, 0, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND pallet_labels.created_at <  DATEADD(DAY, 1, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND pallet_labels.deleted_at IS NULL
) p GROUP BY sort"
        ));

        $totWeight = DB::select(DB::raw(
            "SELECT SUM(p.weight) as weight from (
select
(select b.weight from (select (select cast((((select inset_gram from articles where id = pallet_labels.article_id) * (select inset_limit from articles where id = pallet_labels.article_id)) * article_amount) / 1000 as numeric(36,2)) from articles where articles.id = pallet_labels.article_id) as weight) b) as weight
from pallet_labels
JOIN articles ON articles.id = pallet_labels.article_id
WHERE farmer_id = '$id->id' AND pallet_labels.created_at  >= DATEADD(DAY, 0, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND pallet_labels.created_at <  DATEADD(DAY, 1, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND pallet_labels.deleted_at IS NULL
) p
"
        ));

        $avgWeight = DB::select(DB::raw(
            "SELECT (cast((SUM(p.weight) / (select count(id) from pallet_labels WHERE farmer_id = '$id->id' AND pallet_labels.created_at  >= DATEADD(DAY, 0, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND pallet_labels.created_at <  DATEADD(DAY, 1, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)))) as numeric(36,2))) as avg from (
select
(select b.weight from (select (select cast((((select inset_gram from articles where id = pallet_labels.article_id) * (select inset_limit from articles where id = pallet_labels.article_id)) * article_amount) / 1000 as numeric(36,2)) from articles where articles.id = pallet_labels.article_id) as weight) b) as weight
from pallet_labels
JOIN articles ON articles.id = pallet_labels.article_id
WHERE farmer_id = '$id->id' AND pallet_labels.created_at  >= DATEADD(DAY, 0, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND pallet_labels.created_at <  DATEADD(DAY, 1, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND pallet_labels.deleted_at IS NULL
) p"
        ));

        $palletlabelsCount = DB::select(DB::raw(
            "SELECT COUNT(id) as totalLabels FROM pallet_labels where farmer_id = '$id->id' AND created_at  >= DATEADD(DAY, 0, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND created_at <  DATEADD(DAY, 1, DATEDIFF(DAY, 0, CURRENT_TIMESTAMP)) AND deleted_at IS NULL"
        ));

//        dd($palletlabelsCount['0']->totalLabels);

        if ($palletlabelsCount['0']->totalLabels === "0") {
            return [];
        }

        $totArr = [
            "avg_weight" => $avgWeight,
            "total_weight" => $totWeight,
            "total_labels" => $palletlabelsTotal,
            "weight_persort" => $sortsTotal,
            "total_labelsCount" => $palletlabelsCount,
            "lastupdate" => date("d-m-Y h:i:s")
        ];

        return new LogisticResource($totArr);

////        dd('hoi');
//        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
//        $article = Article::all();
//        $statuses = Status::all();
//        $palletlabels = PalletLabel::where('farmer_id', $currentFarmer->id)->where('crop_date', date('Y-m-d'))->get();
////       $palletlabels = PalletLabel::where('farmer_id', $currentFarmer->id)->get();
//        $sorts = SortType::all();
//
//
////        $palletweight = 0;
//        $reportLabels = [];
//        $totpalletweight = 0;
//        if (!sizeof($palletlabels)){
//            return [];
//        }
//        foreach ($palletlabels as $pallet) {
//
//            foreach ($statuses as $status){
////                dd(is_int($pallet["status_id"]));
////                dd($status);
////                dd($pallet["status_id"]);
////                dd($pallet);
////                var_dump((int)$status["id"] === (int)$pallet["status_id"]);
//                if((int)$status["id"] === (int)$pallet["status_id"]){
//                    $statusdesc = $status["name"];
//                }
//            }
//
//
//
//            $reportLabel = [
//                "id" => $pallet['id'],
//                "crop_date" => $pallet['crop_date']->format('Y-m-d'),
//                "article_amount" => $pallet['article_amount'],
//                "note" => $pallet['note'],
//                "cell_number" => $pallet['cell_number'],
//                "cell_description" => $pallet['cell_description'],
//                "status_description" => $statusdesc,
////                "status_id" => 1
////                "article_id" => 1
//                //weight
//                //sort
//                //statusdescpriton
//            ];
//
//            $articleid = $pallet["article_id"];
//            $palletweight = 0;
//            foreach ($article as $index => $art) {
//
//                $artSortType = $art["sort_type_id"];
//                foreach ($sorts as $sort) {
////                    dd($art["id"]);
//                    if ((int)$articleid === (int)$art["id"]) {
//                        $sortid = $sort["id"];
//                        if ((int)$artSortType === (int)$sortid) {
//                            $indexes[] = $index;
//                            $palletweight += (($art["inset_gram"] * $art["inset_limit"]) * $pallet["article_amount"]);
//                            $totpalletweight += (($art["inset_gram"] * $art["inset_limit"]) * $pallet["article_amount"]);
//
//                            $sortDesc = $sort["description"];
//                            if (!isset($uniqueSort[$sortDesc])) {
//                                $uniqueSort[$sortDesc] = 0;
//                            }
//                            $uniqueSort[$sortDesc] += round((($art["inset_gram"] * $art["inset_limit"]) * $pallet["article_amount"]) / 1000, 2);
//                            $reportLabel["sort"] =  $sortDesc;
//                        }
//
//                    }
//
//                }
//
//
//            }
//            $reportLabel["weight"] = round(($palletweight) / 1000, 2);
//            $reportLabels[] = $reportLabel;
//
//
//
//        }
////        dd($reportLabels);
////        dd($reportLabels);
//        $totalpallets = sizeof($palletlabels);
//        $avgpalletweight = round(($totpalletweight / sizeof($palletlabels)) / 1000, 2);
//        $totalpalletweight = round(($totpalletweight) / 1000, 2);
////        $sortChartArr = "1";
//        $sortChartArr = $uniqueSort;
//
////        $sortChartArr = [
////            "test" => 20,
////            "test2" => 20,
////            "test3" => 20,
////            "test4" => 20,
////            "test5" => 20,
////            "test6" => 20,
////            "test7" => 20,
////            "test8" => 20,
////            "test9" => 20,
////        ];
//
//        $totArr = [
//            "totalpallets" => $totalpallets,
//            "avgpalletweight" => $avgpalletweight,
//            "totalpalletweight" => $totalpalletweight,
//            "sortchartarr" => $sortChartArr,
//            "labels" => $reportLabels,
//        ];
//
//        return $totArr;
//
////        return ReportResource::collection(PalletLabel::where('farmer_id', $currentFarmer->id)->where('crop_date', '2020-01-22')->get());
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
