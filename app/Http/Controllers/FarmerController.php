<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Http\Resources\FarmerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Farmer::class);
    }


    public function index()
    {
        return FarmerResource::collection(Farmer::all());
    }

    /**
     * store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer) : FarmerResource
    {
        return new FarmerResource($farmer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Farmer $farmer, Request $request) : FarmerResource
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $farmer = Farmer::withTrashed()->where('id', $id)->first();

        if ($farmer->trashed()){
            $farmer->restore();
        }
        else {
            $farmer->delete();
        }
        return new FarmerResource($farmer);
    }
}
