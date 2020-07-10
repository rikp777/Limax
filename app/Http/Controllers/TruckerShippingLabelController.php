<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Http\Resources\PalletLabelResource;
use App\Http\Resources\ShippingLabelResource;
use App\PalletLabel;
use App\ShippingLabel;
use App\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Request as CookieRequest;
use Illuminate\Support\Facades\Auth;

class TruckerShippingLabelController extends Controller
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
//        dd($request['truckershipping_label']['farmid']);
        $palletIDs = [];

//        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
        $truck = Truck::where('user_id', auth()->user()->id)->first();

        $shippingLabel = new ShippingLabel();
        $shippingLabel->transport_delivery_date = Carbon::now()->format('Y-m-d');
        $shippingLabel->transport_date = Carbon::now()->format('Y-m-d');
        $shippingLabel->transport_driver = auth()->user()->id;
        $shippingLabel->user_id = auth()->user()->id;
        $shippingLabel->status_id = 2;
        $shippingLabel->farmer_id = $request['truckershipping_label']['farmid'];
//        $shippingLabel->farmer_id = $currentFarmer->id;
        $shippingLabel->truck_id = $truck->id;
        $shippingLabel->transport_driver_user_id = auth()->user()->id;
        $shippingLabel->save();

        foreach ($request['truckershipping_label']['palletlabels'] as $key) {
            array_push($palletIDs, $key);
        }

        $shippingLabel->palletLabels()->attach($palletIDs);

        return $shippingLabel;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        $palletlabel = PalletLabel::find($id);

        if (!$palletlabel) {
            $status = 'false';
        } else {
            if ($palletlabel->status_id === 2) {
                $status =  'true';
            } else {
                $status = 'false';
            }
        }

        $scanReturn = [
            "status" => $status,
            "palletlabel" => $palletlabel,
        ];
        return $scanReturn;
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
