<?php

namespace App\Http\Controllers;

use App\Notifications\PalletlabelWeight;
use App\PalletLabel;
use App\PalletLabelWeightCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PalletLabelWeightCheckController extends Controller
{

    public function index()
    {
        return PalletLabelWeightCheck::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'palletlabel_id' => 'required|int',
            'actual_weight' => 'required|int',
        ]);

        $palletlabel = PalletLabel::find($request->palletlabel_id);

        $palletlabelWeightCheck = New PalletLabelWeightCheck();
        $palletlabelWeightCheck->expected_weight = (($palletlabel->article->inset_gram * $palletlabel->article_amount) + $palletlabel->palletType->weight) * 1.04;
        $palletlabelWeightCheck->actual_weight = $request->actual_weight;
        $palletlabelWeightCheck->percentage =  round(((($request->actual_weight)) / (($palletlabelWeightCheck->expected_weight)) * 100) - 100, 2);
        $palletlabelWeightCheck->valid = ($request->actual_weight < ($palletlabelWeightCheck->expected_weight)) ? false : true;
        $palletlabelWeightCheck->pallet_label_id = $request->palletlabel_id;
        $palletlabelWeightCheck->save();

        if(!$palletlabelWeightCheck->valid){
            $user = \App\User::first();
            $user->notify(new PalletlabelWeight($palletlabelWeightCheck));
        }

        return $palletlabelWeightCheck;
    }

    public function show(PalletLabelWeightCheck $palletLabelWeightCheck)
    {
        //
    }

    public function update(Request $request, PalletLabelWeightCheck $palletLabelWeightCheck)
    {
        //
    }

    public function destroy(PalletLabelWeightCheck $palletLabelWeightCheck)
    {
        //
    }
}
