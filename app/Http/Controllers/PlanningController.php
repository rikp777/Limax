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

        $planning = Planning::where('cell_id', $request->planning['cell']['id'])
            ->where('farmer_id', $currentFarmer->id)
            ->where('status_id', '!=', 10)
            ->where('date', $request->planning['date'])->first();

        $planningAmountQry = PlanningAmount::where('planning_id', $planning['id'])->where('sort_type_id', $sort['id'])->first();

        if ($planning) {

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
    public function show(Request $request, $id)
    {
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
        $article = article::all();
        $statuses = status::all();
        $palletlabels = PalletLabel::where('status_id', 1)->where('farmer_id', $id)->latest('id')->get();

        //get the articles that have sort id's from the article selection the farmer made.
        $sorts = $currentFarmer->articles()->get();

//     $sorts = SortType::all();
        $cells = cell::where('farmer_id', $id)->get();

        foreach ($cells as $cell) {

            foreach ($sorts as $sortAll) {
                //get the description of the sorts based on article selection made by farmer
                $sortDesc = SortType::where('id', $sortAll["sort_type_id"])->first();

                $period = CarbonPeriod::create(Carbon::now()->subDays(3)->format('Y-m-d'), Carbon::now()->addDays(7)->format('Y-m-d'));
                foreach ($period as $date) {
//                    dd($sortDesc["description"]);
                    $tom1[$cell["id"]][$date->toDateTimeString()][$sortDesc["description"]] = null;
                    $tom[$cell["id"]][$date->toDateTimeString()][$sortDesc["description"]] = null;
                    $planning = Planning::where('farmer_id', $id)->where('cell_id', $cell["id"])->get();

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

                            if ($date->toDateTimeString() === $plan["date"]) {
//                                var_dump($date->toDateTimeString() === $plan["date"]);
//                            if ($sortAll["description"] === $sort->description) {
                                $planningsArr[$date->toDateTimeString()][$sort->description] = $planningArr;

                                $sortAmount = PlanningAmount::where('planning_id', $plan->id)->where('sort_type_id', $sortAll["id"])->first();
//                                dd($sortAmount);
                                $tom2[$cell["id"]][$date->toDateTimeString()][$sortDesc["description"]] = $sortAmount["amount"];
                                dd($tom2);

                                $tom = (array_replace_recursive($tom1, $tom2));
//                                dd($tom);
//                                var_dump($tom);
//                             $planningsArr[$date->toDateTimeString()][$sort->description] = $planningArr;
//                            }
                            }


//                         $datesFormatted = $date->format('Y-m-d');

                            $dates = $period->toArray();
//                         $planningsArr[$plan["cell_id"]][$plan["date"]][$planningAm["sort_type_id"]][] = $planningAm;
                        }
                    }
                }
            }



                $prognoseRay = Planning::whereIn('status_id', [9, 10])->where('farmer_id', $id)->where('cell_id', $cell["id"])->get();

                $period = CarbonPeriod::create(Carbon::now()->subDays(3)->format('Y-m-d'), Carbon::now()->addDays(7)->format('Y-m-d'));
                foreach ($period as $date) {
                    $prognoseArray[$cell["id"]][$date->toDateTimeString()] = false;
                }

                if ($prognoseRay) {
                    foreach ($prognoseRay as $item) {
//                    $testtomtom[$item["cell_id"]][$item["date"]] = $item["status_id"];
                        $statusesasdf = Status::where('id', '=', $item["status_id"])->first();
                        if ($item["status_id"] === 9) {
                            $prognoseArr = false;
                        } elseif ($item["status_id"] === 10) {
                            $prognoseArr = true;
                        }

                        $prognoseArray[$item["cell_id"]][$item["date"]] = $prognoseArr;

//                        $prognoseArray[$cell["id"][$date->toDateTimeString()]] = $prognoseArr;
                    }
                }

//            $prognoseArray[] = $prognoseArr;

        }

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
            ];

            $articleid = $pallet["article_id"];
            $palletweight = 0;

            if (!isset($articlesList[$articleid])) {
                $articlesList[$articleid] = 0;
            }
            $articlesList[$articleid] += $pallet["article_amount"];

            foreach ($article as $index => $art) {

                $artSortType = $art["sort_type_id"];

                foreach ($sorts as $sort) {
//                    if ($articleid === $art["id"]) {
//                        var_dump($articleid . '===' . $art["id"]);
                        $sortid = $sort["sort_type_id"];
//                        var_dump($artSortType . ' ' . $sortid);
                        if ($artSortType === $sortid) {

                            $indexes[] = $index;
                            $palletweight += (intval($art["inset_gram"]) * intval($pallet["article_amount"]));
                            $totpalletweight += (intval($art["inset_gram"]) * intval($pallet["article_amount"]));

//                            $sortDesc = $sort["sort_type_id"];
                            $sortDesc = SortType::where('id', $sort["sort_type_id"])->first();
//                            dd($sort);
                            if (!isset($uniqueSort[$sortDesc["description"]])) {
                                $uniqueSort[$sortDesc["description"]] = 0;
//                                var_dump($uniqueSort);
                            }
                            $uniqueSort[$sortDesc["description"]] += round((intval($art["inset_gram"]) * intval($pallet["article_amount"])) / 1000, 2);
                            $reportLabel["sort"] = $sortDesc["description"];
//                            var_dump($uniqueSort);
                        }

//                    }

                }

            }
            $reportLabel["weight"] = round(($palletweight) / 1000, 2);
            $reportLabels[] = $reportLabel;

        }

        $totalpallets = sizeof($palletlabels);
        $avgpalletweight = round(($totpalletweight / sizeof($palletlabels)) / 1000, 2);
        $totalpalletweight = round(($totpalletweight) / 1000, 2);

        $sortChartArr = $uniqueSort;

        $totArr = [
            "totalpallets" => $totalpallets,
            "avgpalletweight" => $avgpalletweight,
            "totalpalletweight" => $totalpalletweight,
            "sortchartarr" => $sortChartArr,
            "groupedarticles" => $articlesList,
            "labels" => $reportLabels,
            "planning" => $tom,
            "prognose" => $prognoseArray,
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
     * @param string $date
     * @return PlanningResource
     */
    public function update(Request $request, $id)
    {
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
        $planningQry = Planning::where('cell_id', '=', $request["planning"]["cell_id"])->whereDate('date', Carbon::parse($request["planning"]["date"]))->where('farmer_id', $currentFarmer->id)->first();
//        dd($planningQry->status_id);

        if($planningQry) {
            $planning = $planningQry;
            $planning->status_id = 10;
            $planning->update();
        } else {
            $planningNew = new Planning();
            $planningNew->date = Carbon::parse($request["planning"]["date"]);
            $planningNew->cell_id = $request["planning"]["cell_id"];
            $planningNew->farmer_id = $currentFarmer->id;
            $planningNew->status_id = 10;
            $planningNew->save();
        }


        return new PlanningResource($planningQry);
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
