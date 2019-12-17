<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cell;
use App\Farmer;
use App\Http\Resources\PalletLabelResource;
use App\PalletLabel;
use App\PalletType;
use App\ShippingLabel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Request as CookieRequest;
use Illuminate\Support\Facades\Route;

class PalletLabelStatusController extends Controller
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

//        $request->validate([
//            'crop_date' => 'required|date',
//            'article_amount' => 'required|int',
//            'article_id' => 'required|int',
//            'pallet_type_id' => 'required|int',
//            'cell_id' => 'required|int',
//            'harvest_cycle' => ' required|int',
//            'harvest_cycle_day' => ' required|int',
//            'note' => 'max:500',
//        ]);

        $farmerId = CookieRequest::header('farmerId');
        $currentFarmer = Farmer::find($farmerId);
        $authUser = auth()->user();

        //insert palletLabel
        $palletlabel = Palletlabel::where('farmer_id', $currentFarmer->id)->where('id', $id)->first();
        $palletlabel->status_id = 2;


        $palletlabel->save();

        return new PalletLabelResource($palletlabel);
    }
}
