<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Http\Resources\PalletLabelResource;
use App\Http\Resources\ShippingLabelResource;
use App\PalletLabel;
use App\ShippingLabel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Request as CookieRequest;
use Illuminate\Support\Facades\Auth;

class ShippingLabelController extends Controller
{


    public function index()
    {
        $farmerId = CookieRequest::header('farmerId');
        $currentFarmer = Farmer::find($farmerId);
        $authUser = auth()->user();

//        return ShippingLabelResource::collection(ShippingLabel::latest('id')->first());
        return ShippingLabelResource::collection(ShippingLabel::where('farmer_id', $currentFarmer->id)->latest('id')->get());

        //ctrlfFARMERID change farmer id to route
    }


    public function store(Request $request)
    {
//        dd($request['shipping_label']);
//        dd('hoi');
        $farmerId = CookieRequest::header('farmerId');
        $currentFarmer = Farmer::find($farmerId);
        $request->validate([
            'shipping_label.trucker_id' => 'required',
            'shipping_label.pallet_labels' => 'required',
            'shipping_label.license_id' => 'required',
            'shipping_label.delivery_date' => 'required'
        ]);
        //create shippingLabel
        $shippingLabel = new ShippingLabel();
        $shippingLabel->transport_delivery_date = Carbon::parse($request->shipping_label['delivery_date'])->format('Y-m-d');
        $shippingLabel->transport_date = Carbon::now()->format('Y-m-d');
        $shippingLabel->transport_driver = $request->shipping_label['trucker_id'];
        $shippingLabel->user_id = auth()->user()->id;
        $shippingLabel->status_id = 2;
        //ctrlfFARMERID change farmer id to route
        $shippingLabel->farmer_id = $currentFarmer->id;
        $shippingLabel->truck_id = $request->shipping_label['license_id'];
        $shippingLabel->transport_driver_user_id = $request->shipping_label['trucker_id'];
        $shippingLabel->save();

        $shippingLabel->palletLabels()->attach($request->shipping_label['pallet_labels']);

//        $shippingLabel->palletlabels()->attach($request->palletlabels);
//        $shippingLabel->palletlabels()->update(['status_id' =>1]);

        return $shippingLabel;
    }


    public function show(ShippingLabel $shippinglabel) : ShippingLabelResource
    {
//        dd($shippinglabel->id);
//        dd('hoi');
//        dd(PalletLabel::whereRaw("ID IN (SELECT pallet_label_id FROM pallet_label_shipping_label WHERE shipping_label_id = '$shippinglabel->id')")->get());
        return new ShippingLabelResource(PalletLabel::whereRaw("ID IN (SELECT pallet_label_id FROM pallet_label_shipping_label WHERE shipping_label_id = '$shippinglabel->id')")->get());
        //ctrlfFARMERID change farmer id to route
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
