<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cell;
use App\Farmer;
use App\PalletLabel;
use App\Planning;
use App\PlanningAmount;
use App\SortType;
use App\Status;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PlanningFastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return array
     */
    public function show(Request $request, $id)
    {
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
        //get the articles that have sort id's from the article selection the farmer made.
        $sorts = $currentFarmer->sort_types()->get();
        // id name description
        if (!sizeof($sorts)) {
            return [];
        }

        $period = CarbonPeriod::create(Carbon::now()->subDays(3)->format('Y-m-d'), Carbon::now()->addDays(7)->format('Y-m-d'));
//        $period = CarbonPeriod::create(Carbon::now()->subDays(3)->format('Y-m-d'), Carbon::now()->addDays(7)->format('Y-m-d'));
            foreach ($sorts as $sortAll) {
                //get the description of the sorts based on article selection made by farmer
//                $sortDesc = SortType::where('id', $sortAll["sort_type_id"])->first();
                foreach ($period as $date) {
                    $tom1[$id][$date->toDateTimeString()][$sortAll["description"]] = null;
                    $tom[$id][$date->toDateTimeString()][$sortAll["description"]] = null;
                    $planning = Planning::where('farmer_id', $currentFarmer->id)->where('cell_id', $id)->get();

                    foreach ($planning as $plan) {
                            if ($date->toDateTimeString() === $plan["date"]->toDateTimeString()) {
                                $sortAmount = PlanningAmount::where('planning_id', $plan->id)->where('sort_type_id', $sortAll["id"])->first();
                                $tom2[$id][$date->toDateTimeString()][$sortAll["description"]] = $sortAmount["amount"];
                                $tom = (array_replace_recursive($tom1, $tom2));
                            }
                    }
                }
            }
            $prognoseRay = Planning::whereIn('status_id', [9, 10])->where('farmer_id', $currentFarmer->id)->where('cell_id', $id)->get();
            foreach ($period as $date) {
                $prognoseArray[$id][$date->toDateTimeString()] = false;
            }
            if ($prognoseRay) {
                foreach ($prognoseRay as $item) {
                    if ((int)$item["status_id"] === 9) {
                        $prognoseArr = false;
                    } elseif ((int)$item["status_id"] === 10) {
                        $prognoseArr = true;
                    }
                    $prognoseArray[(int)$item["cell_id"]][$item["date"]->toDateTimeString()] = $prognoseArr;
                }
            }

            $totArr = [
                "planning" => $tom,
                "prognose" => $prognoseArray,
            ];
        return $totArr;
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
