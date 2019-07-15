<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Http\Resources\PalletLabelResource;
use App\Http\Resources\ShippingLabelResource;
use App\PalletLabel;
use App\ShippingLabel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingLabelController extends Controller
{


    public function index()
    {
        return new ShippingLabelResource(ShippingLabel::where('Farmer_id', Farmer::getCurrentFarmerId()));
    }


    public function store(Request $request)
    {
        $request->validate([
            'trucker' => 'required',
            'license_plate' => 'required',
            'delivery_date' => 'required|date'
        ]);

        //create shippingLabel
        $shippingLabel = new ShippingLabel();
        $shippingLabel->transport_date_delivery = Carbon::parse($request->delivery_date)->format('Y-m-d');
        $shippingLabel->transport_date = Carbon::now()->format('Y-m-d');
        $shippingLabel->transport_driver = $request->trucker;
        $shippingLabel->user_id = auth()->user()->id;
        $shippingLabel->status_id = 1;
        $shippingLabel->farmer_id = Farmer::getCurrentFarmerId();
        $shippingLabel->truck_id = $request->truck_id;
        $shippingLabel->transport_driver_user_id = $request->transport_driver_user_id;
        $shippingLabel->save();

        $shippingLabel->palletlabels()->attach($request->palletlabels);
        $shippingLabel->palletlabels()->update(['status_id' =>1]);

        return $shippingLabel;
    }


    public function show(ShippingLabel $shippingLabel) : ShippingLabelResource
    {
        return new ShippingLabelResource($shippingLabel);
    }


    public function update(Request $request, ShippingLabel $shippingLabel)
    {
        $request->validate([
            'trucker' => 'required',
            'license_plate' => 'required',
            'delivery_date' => 'required|date'
        ]);

        //update shippingLabel
        $shippingLabel->transport_date_delivery = Carbon::parse($request->delivery_date)->format('Y-m-d');
        $shippingLabel->transport_date = Carbon::now()->format('Y-m-d');
        $shippingLabel->transport_driver = $request->trucker;
        $shippingLabel->user_id = auth()->user()->id;
        $shippingLabel->truck_id = $request->truck_id;
        $shippingLabel->transport_driver_user_id = $request->transport_driver_user_id;
        $shippingLabel->update();

        $shippingLabel->palletlabels()->attach($request->palletlabels);
        $shippingLabel->palletlabels()->update(['status_id' =>1]);

        return $shippingLabel;
    }


    public function destroy($id)
    {
        $shippingLabel = ShippingLabel::withTrashed()->where('id', $id)->first();

        if ($shippingLabel->trashed()){
            $shippingLabel->restore();
        }
        else {
            $shippingLabel->delete();
        }

        return new ShippingLabelResource($shippingLabel);
    }
}
