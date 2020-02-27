<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cell;
use App\Farmer;
use App\Http\Resources\PalletLabelResource;
use App\Http\Resources\PlanningResource;
use App\PalletLabel;
use App\SortType;
use App\Status;
use App\Planning;
use App\PlanningAmount;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Request as CookieRequest;
use Carbon\Carbon;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|null
     */
    public function index(Request $request)
    {
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
        if ($currentFarmer) {
            return PalletLabelResource::collection(PalletLabel::where('status_id', 1)->get());
//            return PalletLabelResource::collection(PalletLabel::where('status_id', 1)->where('crop_date', date('Y-m-d'))->get());
        }
        return null;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'planning.cell' => ' required',
            'planning.sort' => ' required',
            'planning.date' => ' required',
            'planning.amount' => ' required',
        ]);
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();

        $sort = SortType::where('name', $request->planning['sort'])->first();
//        date, cell, farmer, status
        $planning = Planning::where('cell_id', $request->planning['cell']['id'])
            ->where('farmer_id', $currentFarmer->id)
            ->where('status_id', '!=', 10)
            ->where('date', $request->planning['date'])->first();
//        dd($sort->id);
        $planningAmountQry = PlanningAmount::where('planning_id', $planning['id'])->where('sort_type_id', $sort['id'])->first();

        if ($planning) {
//                dd($planning['id']);
            if ($planningAmountQry) {
                $planningAmount = $planningAmountQry;
                $planningAmount->amount = $request->planning['amount'];
                $planningAmount->update();
            } else {
                $planningWeight = new PlanningAmount();
                $planningWeight->planning_id = $planning->id;
                $planningWeight->sort_type_id = $sort->id;
                $planningWeight->amount = $request->planning['amount'];

                $planningWeight->save();
            }
        } else {
            $planning = new Planning();
            $planning->date = $request->planning['date'];
            $planning->cell_id = $request->planning['cell']['id'];
            $planning->farmer_id = $currentFarmer->id;
            $planning->status_id = 9;

            $planning->save();

            $planningWeight = new PlanningAmount();
            $planningWeight->planning_id = $planning->id;
            $planningWeight->sort_type_id = $sort->id;
            $planningWeight->amount = $request->planning['amount'];

            $planningWeight->save();
        }


        return new PlanningResource($planning);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $farmerId = CookieRequest::header('farmerId');
//
//        $authUser = auth()->user();
//        $currentFarmer = Farmer::find($farmerId);
//
//        return PalletLabelResource::collection(PalletLabel::where('status_id', 1)->where('farmer_id', $id)->where('crop_date', date('Y-m-d'))->latest('id')->get());

        $farmerId = CookieRequest::header('farmerId');
        $currentFarmer = Farmer::find($farmerId);
        $article = article::all();
        $statuses = status::all();
        $palletlabels = PalletLabel::where('status_id', 1)->where('farmer_id', $id)->latest('id')->get();

        $sorts = SortType::all();
        $cells = cell::where('farmer_id', $id)->get();

//        dd($article);


//        $sort = SortType::where('name', $request->planning['sort'])->first();
        foreach ($cells as $cell) {
//            dd($cell);
            $planning = Planning::where('status_id', '!=', 10)->where('farmer_id', $id)->where('cell_id', $cell["id"])->get();

            foreach ($planning as $plan) {
                $planningAmount = PlanningAmount::where('planning_id', $plan->id)->get();

                foreach ($planningAmount as $planningAm) {
                    $sort = SortType::where('id', $planningAm["sort_type_id"])->first();
                    $planningArr = [
                        "cell_id" => $plan["cell_id"],
                        "date" => $plan["date"],
                        "sort" => $sort->description,
                        "sort_type_id" => $planningAm["sort_type_id"],
                        "amount" => $planningAm["amount"]
                    ];

//                { id: 1, name: "Chandler Bing", phone: '305-917-1301', profession: 'IT Manager' },
                    $period = CarbonPeriod::create(Carbon::now()->subDays(3)->format('Y-m-d'), Carbon::now()->addDays(7)->format('Y-m-d'));
                    foreach ($period as $date) {

//                    $planningsArr[$date->toDateTimeString()][$sort->description] = [
//                        "cell_id" => null,
//                        "date" => null,
//                        "sort" => null,
//                        "sort_type_id" => null,
//                        "amount" => null
//                    ];
                        foreach ($sorts as $sortAll) {
                            $tom1[$cell["id"]][$date->toDateTimeString()][$sortAll["description"]] = null;
                            if ($date->toDateTimeString() === $plan["date"]) {
//                            if ($sortAll["description"] === $sort->description) {
                                $planningsArr[$date->toDateTimeString()][$sort->description] = $planningArr;

                                $sortAmount = PlanningAmount::where('planning_id', $plan->id)->where('sort_type_id', $sortAll["id"])->first();

                                $tom2[$cell["id"]][$date->toDateTimeString()][$sortAll["description"]] = $sortAmount["amount"];
                                $tom = (array_replace_recursive($tom1, $tom2));
//                                $planningsArr[$date->toDateTimeString()][$sort->description] = $planningArr;
//                            }
                            }

                        }

//                    $datesFormatted = $date->format('Y-m-d');
                    }
                    $dates = $period->toArray();
//                $planningsArr[$plan["cell_id"]][$plan["date"]][$planningAm["sort_type_id"]][] = $planningAm;
                }
            }
        }
//        $planning = Planning::where('cell_id', $request->planning['cell']['id']
//        )
//            ->where('farmer_id', $currentFarmer->id)
//            ->where('status_id', '!=', 10)
//            ->where('date', $request->planning['date'])->first();
//        dd($sort->id);
//        $planningAmountQry = PlanningAmount::where('planning_id', $planning['id'])->where('sort_type_id', $sort['id'])->first();


//        $palletweight = 0;
        $reportLabels = [];
        $totpalletweight = 0;
        if (!sizeof($palletlabels)) {
            return [];
        }
        foreach ($palletlabels as $pallet) {

            foreach ($statuses as $status) {
                if ($status["id"] === $pallet["status_id"]) {
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
                "farmer_id" => $pallet['farmer_id'],
                "article_id" => $pallet['article_id'],
//                "status_id" => 1
//                "article_id" => 1
                //weight
                //sort
                //statusdescpriton
            ];

            $articleid = $pallet["article_id"];
            $palletweight = 0;

            if (!isset($articlesList[$articleid])) {
                $articlesList[$articleid] = 0;
            }
            $articlesList[$articleid] += $pallet["article_amount"];
//            $articlesList[$articleid] += [
//                "id" => $articleid,
//                "amount" => $pallet["article_amount"]
//            ];
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
                            $reportLabel["sort"] = $sortDesc;
                        }

                    }

                }


            }
            $reportLabel["weight"] = round(($palletweight) / 1000, 2);
            $reportLabels[] = $reportLabel;


        }

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
            "groupedarticles" => $articlesList,
            "labels" => $reportLabels,
            "datesInterval" => $dates,
            "sorts" => $sorts,
            "planning" => $tom,
//            "planning" => $planningsArr,
//            "planning" => $res,
        ];

        return $totArr;
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
     * @return PlanningResource
     */
    public function update(Request $request, $id)
    {
//        dd($request);
//
//        $request->validate([
//            'cell' => ' required',
//            'sort' => ' required',
//            'date' => ' required',
//            'amount' => ' required',
//        ]);
//        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
//
////        date, cell, farmer, status
//        $planning = Planning::where('cell_id', $request->cell['id'])
//            ->where('farmer_id', $currentFarmer->id)
//            ->where('status_id', '!=', 10)
//            ->where('date', $request->date);
//
//        if ($planning) {
//            dd($planning);
//        } else {
//            $planning = new Planning();
//            $planning->date = $request->date;
//            $planning->cell_id = $request->cell['id'];
//            $planning->farmer_id = $currentFarmer->id;
//            $planning->status_id = 9;
//
//            $planning->save();
//        }
//
//        return new PlanningResource($planning);

//        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
//
//        $cell = Cell::where('farmer_id', $currentFarmer->id)->where('id', $request->cell['id'])->first();
////        dd($cell);
//        $cell->description = $request->cell['description'];
//        $cell->save();
//
//        //return
//        return new CellResource($cell);

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
