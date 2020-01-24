<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Http\Resources\PalletLabelResource;
use App\PalletLabel;
use Illuminate\Http\Request;
use Request as CookieRequest;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farmerId = CookieRequest::header('farmerId');

        $authUser = auth()->user();
        $currentFarmer = Farmer::find($farmerId);

        return PalletLabelResource::collection(PalletLabel::where('status_id', 1)->get());
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $farmerId = CookieRequest::header('farmerId');

        $authUser = auth()->user();
        $currentFarmer = Farmer::find($farmerId);

        return PalletLabelResource::collection(PalletLabel::where('status_id', 1)->where('farmer_id', $id)->latest('id')->paginate(10));
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
