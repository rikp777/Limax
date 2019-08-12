<?php

namespace App\Http\Controllers;

use App\CultivationCycle;
use App\CultivationCycleFlight;
use App\Farmer;
use App\Http\Resources\CultivationCycleFlightResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CultivationCycleFlightController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CultivationCycleFlight::class, 'App\CultivationCycleFlight');
    }



    public function index()
    {
        return CultivationCycleFlightResource::collection(CultivationCycleFlight::paginate(15));
    }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'cultivation_cycle_id' => 'exists:cultivation_cycles,id|required|int',
        ]);

        $check = Farmer::getCurrentFarmer()->cultivationCycles->contains($request->cultivation_cycle_id);

        //Values
        $flightDate = Carbon::parse($request->date);
        $cultivationCycle = CultivationCycle::findOrFail($request->cultivation_cycle_id);
        $fillDate = Carbon::parse($cultivationCycle->fill_date);
        $diffBetweenFillAndFlight=  $fillDate->diffInDays($flightDate);
        $cultivationCycleFlight = null;

        //logic
        if($check) {
            if ($diffBetweenFillAndFlight > 14) {
                if (count($cultivationCycle->CultivationCycleFlights) > 0) {
                    $latestFlight = $cultivationCycle->CultivationCycleFlights()->latest()->first();
                    $diffInDays = Carbon::parse($latestFlight->date)->diffInDays($flightDate);
                    if ($diffInDays < 14) {
                        if ($diffInDays > 7) {
                            $cultivationCycleFlight = CultivationCycleFlight::create($request->all());
                        } else {
                            return response()->json(['message' => 'Cultivation: ' . $cultivationCycle->id . ' is still busy'], 422);
                        }
                    } else {
                        return response()->json(['message' => 'You can\'t create the flight, you need to create a new cultivation cycle'], 422);
                    }
                } else {
                    if($diffBetweenFillAndFlight < 20){
                        $cultivationCycleFlight = CultivationCycleFlight::create($request->all());
                    }else{
                        return response()->json(['message' => 'You can\'t create the flight, you need to create a new cultivation cycle'], 422);
                    }
                }
            } else {
                return response()->json(['message' => 'Date has to be more than 14 days over fill date'], 422);
            }
        }

        //return
        return new CultivationCycleFlightResource($cultivationCycleFlight);
    }


    public function show(CultivationCycleFlight $cultivationCycleFlight) : CultivationCycleFlightResource
    {
        return new CultivationCycleFlightResource($cultivationCycleFlight);
    }


    public function update(Request $request, CultivationCycleFlight $cultivationCycleFlight)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $check = Farmer::getCurrentFarmer()->cultivationCycles->contains($request->cultivation_cycle_id);

        //Values
        $flightDate = Carbon::parse($request->date);
        $cultivationCycle = $cultivationCycleFlight->Cultivation();
        $fillDate = Carbon::parse($cultivationCycle->fill_date);
        $diffBetweenFillAndFlight=  $fillDate->diffInDays($flightDate);

        //logic
        if($check) {
            if ($diffBetweenFillAndFlight > 14) {
                $latestFlight = $cultivationCycle->CultivationCycleFlights()->latest()->first();
                $diffInDays = Carbon::parse($latestFlight->date)->diffInDays($flightDate);
                if ($diffInDays < 14) {
                    if ($diffInDays > 7) {
                        $cultivationCycleFlight->update($request->all());
                    } else {
                        return response()->json(['message' => 'Cultivation: ' . $cultivationCycle->id . ' is still busy'], 422);
                    }
                } else {
                    return response()->json(['message' => 'You can\'t create the flight, you need to create a new cultivation cycle'], 422);
                }
            } else {
                return response()->json(['message' => 'Date has to be more than 14 days over fill date'], 422);
            }
        }

        //return
        return new CultivationCycleFlightResource($cultivationCycleFlight);
    }


    public function destroy(CultivationCycleFlight $cultivationCycleFlight)
    {
        $cultivationCycleFlight->delete();
        return new CultivationCycleFlightResource($cultivationCycleFlight);
    }
}
