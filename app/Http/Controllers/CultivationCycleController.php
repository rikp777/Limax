<?php

namespace App\Http\Controllers;

use App\ArticleGroup;
use App\Cell;
use App\CultivationCycle;
use App\CultivationCycleFlight;
use App\Farmer;
use App\Http\Resources\CultivationCycleResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;

class CultivationCycleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CultivationCycle::class, 'App\CultivationCycle');
    }


    public function calculate(Cell $cell)
    {
        $today = Carbon::now();
        $newFlight = 7; //days
        $resetFlight = 14; //days

        $error = false;
        $flight = 0;
        $flightDay = 0;
        $message = null;


        $cultivation = $cell->cultivationCycles()->latest()->first();

        if (isset($cultivation)) {
            $articleGroupId = $cultivation->article_group_id ?: null;
            $fill = $cultivation->fill_date ?: null;
            $daysOver = $today->diffInDays($fill);


            // FILL DATE LOGIC
            if (count($cultivation->CultivationCycleFlights) == 0) {
                if ($daysOver >= $newFlight) {
                    $error = false;
                    $flight = 1;
                    $flightDay = 1;
                    $message = [
                        "You will create the first flight",
                        "Fill-date: " . $fill,
                        "Flight One: " . date('Y-m-d'),
                    ];
                    if ($daysOver >= $resetFlight) {
                        $error = true;
                        $flight = 1;
                        $flightDay = 1;
                        $message = [
                            "You can't create the first flight for this cycle, you are over the max with " . $daysOver . " days, you will create a new cultivation cycle",
                            "Fill-date: " . $fill,
                        ];
                    }
                } else {
                    $error = true;
                    $flight = 0;
                    $flightDay = 0;
                    $message = [
                        "You can't create the first flight for this cycle, you have to wait, " . $daysOver . " more days",
                        "Fill-date: " . $fill,
                    ];
                }
            }

            $flightsString = '';
            foreach ($cultivation->CultivationCycleFlights as $cultivationCycleFlight) {
                $flightsString .= $flightsString . $cultivationCycleFlight->date . ", ";
            }
            //FLIGHT DATE LOGIC
            foreach ($cultivation->CultivationCycleFlights as $cultivationCycleFlight) {
                $date = Carbon::parse($cultivation->CultivationCycleFlights->last()->date);
                //dd($date);
                $daysOver = $today->diffInDays($date) + 1;

                if ($daysOver > $newFlight) {
                    $error = true;
                    $flight = count($cultivation->CultivationCycleFlights) + 1;
                    $flightDay = 1;
                    $message = [
                        "You will create a new Flight with this pallet-label!, Flight " . (count($cultivation->CultivationCycleFlights) + 1),
                        "Fill-date: " . $fill,
                        "Flightdates: " . $flightsString,
                        "This cycle is " . ($daysOver - $newFlight) . " days over its flight max"
                    ];
                    if ($daysOver > $resetFlight) {
                        $error = true;
                        $flight = 0;
                        $flightDay = 0;
                        $message = [
                            "You will create a new cultivation cycle with this pallet-label!",
                            "Current cycle:",
                            "Fill-date: " . $fill,
                            "Flightdates: " . $flightsString,
                            "This cycle is " . ($daysOver - $resetFlight) . " days over its reset max"
                        ];
                    }
                } else {
                    $error = false;
                    $flight = count($cultivation->CultivationCycleFlights);
                    $flightDay = $daysOver;
                }
            }
        } else {
            $error = true;
            $flight = 0;
            $flightDay = 0;
            $message = [
                "You will create the very first cultivation cycle with this pallet-label!",
            ];
        }
        //dd($cultivation);
        $cycle = [
            'data' => [
                'calculation' => [
                    'harvest_cycle' => $flight,
                    'harvest_cycle_day' => $flightDay,
                    'error' => $error,
                    'message' => $message,
                ],
                'raw_data' => [
                    'cell' => [
                        'id' => isset($cultivation) ? $cultivation->cell->id : $cell->id,
                        'number' => isset($cultivation) ? $cultivation->cell->number : $cell->number,
                        'description' => isset($cultivation) ? $cultivation->cell->description : $cell->description,
                    ],
                    'cultivation_cycle' => [
                        'id' => isset($cultivation) ? $cultivation->id : null,
                        'fill_date' => isset($cultivation) ? $cultivation->fill_date : null,
                        'cultivation_cycle_flights' => isset($cultivation) ? $cultivation->cultivation_cycle_flights : null,
                    ],
                    'article_group' => [
                        'id' => isset($cultivation) ? $articleGroupId : null,
                        'name' => isset($cultivation) ? ArticleGroup::find($articleGroupId)->name : null,
                    ],
                ]
            ]
        ];
        return new \Illuminate\Support\Collection($cycle);
    }


    public function index()
    {
        return CultivationCycleResource::collection(CultivationCycle::where('farmer_id', Farmer::getCurrentFarmerId()));
    }


    public function store(Request $request)
    {
        $today = Carbon::now();
        $cellData = Cell::findOrFail($request->cell_id);
        $cultivationCycleData = $cellData->cultivationCycles()->latest()->first();
        $cultivationCycle = null;

        if (isset($cultivationCycleData)) {
            if ($today->diffInDays($cultivationCycleData->fill_date) > 14) {
                $cultivationCycle = new CultivationCycle();
                $cultivationCycle->cell_id = $cellData->id;
                $cultivationCycle->cell_description = $cellData->description;
                $cultivationCycle->fill_date = Carbon::now()->toDateTimeString();
                $cultivationCycle->farmer_id = Farmer::getCurrentFarmer()->id;
                $cultivationCycle->article_group_id = $request->article_group_id;
                $cultivationCycle->save();
            } else {
                abort(409, 'Has to be at least 14 days over fill_date of last cultivation cycle');
            }
        } else {
            $cultivationCycle = new CultivationCycle();
            $cultivationCycle->cell_id = $cellData->id;
            $cultivationCycle->cell_description = $cellData->description;
            $cultivationCycle->fill_date = Carbon::now()->toDateTimeString();
            $cultivationCycle->farmer_id = Farmer::getCurrentFarmer()->id;
            $cultivationCycle->article_group_id = $request->article_group_id;
            $cultivationCycle->save();
        }

        return new CultivationCycleResource($cultivationCycle);
    }


    public function show(CultivationCycle $cultivationCycle)
    {
//        return "Ik ben een gert";
        return new CultivationCycleResource($cultivationCycle);
    }


    public function update(Request $request, CultivationCycle $cultivationCycle)
    {
        $request->validate([
            'cell_description' => 'required|string|min:4|max:25',
            'fill_date' => 'required|date',
            'article_group_id' => 'exists:article_groups,id|required|int',
        ]);

        $cultivationCycle->update($request->all());

        return new CultivationCycleResource($cultivationCycle);
    }


    public function destroy(CultivationCycle $cultivationCycle)
    {
        $cultivationCycle->delete();
        return new CultivationCycleResource($cultivationCycle);
    }
}
