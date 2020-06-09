<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cell;
use App\Farmer;
use App\Http\Resources\PalletLabelResource;
use App\Http\Resources\TruckerPalletLabelResource;
use App\PalletLabel;
use App\PalletType;
use App\ShippingLabel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Request as CookieRequest;
use Illuminate\Support\Facades\Route;

class TruckerPalletLabelStatusController extends Controller
{
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'shipping_pallet_label.id' => 'required',
            'shipping_pallet_label.selected_labels' => 'required',
        ]);
//        dd($request->shipping_pallet_label['id']);
//        dd($request->shipping_pallet_label['selected_labels']);

//        $shippingpalletLabel = new ShippingPalletLabel();
        foreach ($request->shipping_pallet_label['selected_labels'] as $shippingPalletLabel){
//            $shippingpalletLabel->shippinglabel_id = $request->shipping_pallet_label['id'];
//            $shippingpalletLabel->palletlabel_id = $shippingPalletLabel;
//            $shippingpalletLabel->save();
            $shippingpalletLabel = ShippingLabel::create($request->shipping_pallet_label['id']);
            $shippingpalletLabel->palletLabels()->sync($request->$shippingPalletLabel);
        }
//        return $shippingpalletLabel;


        return "hoi";
    }

    public function update(Request $request, $id)
    {
//        dd($id);
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
        $authUser = auth()->user();

        //insert palletLabel
        $palletlabel = Palletlabel::where('farmer_id', $currentFarmer->id)->where('id', $id)->first();
        $palletlabel->status_id = 2;


        $palletlabel->save();

        return new TruckerPalletLabelResource($palletlabel);
    }
}
