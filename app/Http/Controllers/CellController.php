<?php

namespace App\Http\Controllers;

use App\Cell;
use App\CultivationCycle;
use App\CultivationCycleFlight;
use App\Farmer;
use App\Http\Resources\CellResource;
use Illuminate\Http\Request;
use Request as CookieRequest;

class CellController extends Controller
{

    public function index(Request $request)
    {
        $currentFarmer = Farmer::where('uid', $request->header("authFarmer"))->first();
        return CellResource::collection(Cell::where('farmer_id', $currentFarmer->id)->get());
    }

    /**
     * store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CellResource
     */
    public function store(Request $request)
    {

        $request->validate([
            'cell' => ' required',
        ]);



        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
        $number = Cell::where('farmer_id', $currentFarmer->id)->orderBy('id', 'desc')->first();
//        dd($number);

        $cell = new Cell();
        if ($number === null) {
            $cell->number = 1;
        } else {
            $cell->number = $number->number + 1;
        }
        $cell->farmer_id = $currentFarmer->id;
        $cell->description = $request->cell;
        $cell->save();

        $cultivationcycle = new CultivationCycle();
        $cultivationcycle->cell_description = $request->cell;
        $cultivationcycle->fill_date = '2019-01-03';
        $cultivationcycle->cell_id = $cell->id;
        $cultivationcycle->farmer_id = $currentFarmer->id;
        $cultivationcycle->article_group_id = 1;
        $cultivationcycle->save();

        $cultivationcycleflight = new CultivationCycleFlight();
        $cultivationcycleflight->date = '2019-01-03';
        $cultivationcycleflight->cultivation_cycle_id = $cultivationcycle->id;
        $cultivationcycleflight->save();

        //dd(Cell::where('farmer_id', $currentFarmer->id)->orderBy('id', 'desc')->first());
//        $cell = new Cell();
//        $cell->number = $number->number+1;
//        $cell->farmer_id = $currentFarmer->id;


        return new CellResource($cell);
    }

    /**
     * Display the specified resource.
     *
     * @param Cell $cell
     * @return CellResource
     */
    public function show(Cell $cell) : CellResource
    {
//        $currentFarmer = Farmer::where('uid', $request->header("authFarmer"))->first();
//        return CellResource(Cell::where('farmer_id', $currentFarmer->id)->where('id', $id)->get());
        return new CellResource($cell);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return CellResource
     */
    public function update(Request $request)
    {
        //
//        dd($request);
        $request->validate([
            'cell.description' => ' required',
        ]);
//        dd($request->cell['description']);
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();

        $cell = Cell::where('farmer_id', $currentFarmer->id)->where('id', $request->cell['id'])->first();
//        dd($cell);
        $cell->description = $request->cell['description'];
        $cell->save();

        //return
        return new CellResource($cell);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cell = Cell::withTrashed()->where('id', $id)->first();
        dd($cell);
        if ($cell->trashed()) {
            $cell->restore();
        }
        else {
            $cell->softDeletes();
        }

        return new CellResource($cell);

    }

}
