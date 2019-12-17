<?php

namespace App\Http\Controllers;

use App\Http\Resources\TruckResource;
use App\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
//    public function __construct()
//    {
//        $this->authorizeResource(Truck::class);
//    }

    public function index()
    {
        return TruckResource::collection(Truck::all());
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
    public function show(Truck $truck) : TruckResource
    {
        return new TruckResource($truck);
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
