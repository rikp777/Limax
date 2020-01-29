<?php

namespace App\Http\Controllers;


use App\Article;
use App\Cell;
use App\CultivationCycle;
use App\Farmer;
use App\Http\Resources\ArticleFarmerResource;
use App\Http\Resources\PalletLabelResource;
use App\PalletLabel;
use App\PalletType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Request as CookieRequest;
use Illuminate\Support\Facades\Route;
//use Illuminate\Routing\Route;

class PalletLabelController extends Controller
{
    public function __construct()
    {
//        dd(PalletLabel::whereRaw('ID IN (SELECT pallet_label_id FROM pallet_label_shipping_label WHERE shipping_label_id = 18)')->get());
        //$this->authorizeResource(PalletLabel::class, 'App\PalletLabel'); //BugFix
    }


    public function index(Request $request)
    {
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();
//        dd($request->header('authFarmer'));
        if($currentFarmer){
            $palletlabels = PalletLabel::where('status_id', 1)->where('farmer_id', $currentFarmer->id)->latest('id')->get();

            return PalletLabelResource::collection($palletlabels);
        }
        return null;
    }


    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'crop_date' => 'required|date',
            'article_amount' => 'required|int',
            'article_id' => 'required',
            'pallet_type_id' => 'required',
            'cell_id' => 'required|int',
            'harvest_cycle' => ' required|int',
            'harvest_cycle_day' => ' required|int',
            'note' => 'max:500',
        ]);


        $authUser = auth()->user();
        //ctrlfFARMERID change farmer id to route
        $farmerId = CookieRequest::header('farmerId');
        $currentFarmer = Farmer::find($farmerId);
        $article = Article::findOrFail($request->article_id);
        $palletType = PalletType::findOrFail($request->pallet_type_id);
        $cell = Cell::findOrFail($request->cell_id);
        $cultivationcycle = CultivationCycle::where('cell_id', $cell->id)->first();
//        dd($cultivationcycle);

        //autoincrement unique palletlabel farmer id
        $palletlabelFarmerId = 0;
        $palletlabelFarmer = Palletlabel::where('farmer_id', $currentFarmer->id)->orderby('id', 'desc')->first();
        if ($palletlabelFarmer) {
            $palletlabelFarmerId = $palletlabelFarmer->pallet_label_farmer_id + 1;
        }

        //insert palletLabel
        $palletlabel = new Palletlabel();
//        $palletlabel->crop_date = Carbon::parse($request->crop_date);
        $palletlabel->crop_date = $request->crop_date;
        $palletlabel->article_amount = $request->article_amount;
        $palletlabel->note = $request->note;
        $palletlabel->pallet_label_farmer_id = $palletlabelFarmerId;
        $palletlabel->made_by = $authUser->first_name;
        $palletlabel->user_id = $authUser->id;
        //ctrlfFARMERID change farmer id to route
        $palletlabel->farmer_id = $currentFarmer->id;
        $palletlabel->pallet_type_id = $palletType->id;
        $palletlabel->status_id = 1;
        $palletlabel->article_id = $article->id;
        $palletlabel->cultivation_cycle_id = $cultivationcycle->id;
//        $palletlabel->harvest_cycle = $cultivationCycleCalculation['data']['calculation']['harvest_cycle'];
//        $palletlabel->harvest_cycle_day = $cultivationCycleCalculation['data']['calculation']['harvest_cycle_day'];
        $palletlabel->harvest_cycle = $request->harvest_cycle;
        $palletlabel->harvest_cycle_day = $request->harvest_cycle_day;
        $palletlabel->cell_number = $cell->number;
        $palletlabel->cell_description = $cell->description;
        $palletlabel->cell_id = $request->cell_id;
         $palletlabel->save();

        //return
        return new PalletLabelResource($palletlabel);
    }


    public function show(PalletLabel $palletlabel) : PalletLabelResource
    {
        return new PalletLabelResource($palletlabel);
    }

    public function update(Request $request, $id)
    {

//        dd($id);

        $request->validate([
            'crop_date' => 'required|date',
            'article_amount' => 'required|int',
            'article_id' => 'required|int',
            'pallet_type_id' => 'required|int',
            'cell_id' => 'required|int',
            'harvest_cycle' => ' required|int',
            'harvest_cycle_day' => ' required|int',
            'note' => 'max:500',
        ]);

        $authUser = auth()->user();
        //ctrlfFARMERID change farmer id to route
        $farmerId = CookieRequest::header('farmerId');
        $currentFarmer = Farmer::find($farmerId);
        $article = Article::findOrFail($request->article_id);
        $palletType = PalletType::findOrFail($request->pallet_type_id);
        $cell = Cell::findOrFail($request->cell_id);

        //dd($cultivationCycleCalculation);
        //autoincrement unique palletlabel farmer id
        $palletlabelFarmerId = 0;
        $palletlabelFarmer = Palletlabel::where('farmer_id', $currentFarmer->id)->orderby('id', 'desc')->first();
//        if ($palletlabelFarmer) {
//            $palletlabelFarmerId = $palletlabelFarmer->pallet_label_farmer_id + 1;
//        }


        //insert palletLabel
        $palletlabel = Palletlabel::where('farmer_id', $currentFarmer->id)->where('id', $id)->first();
        $palletlabel->crop_date = Carbon::parse($request->crop_date);
        $palletlabel->article_amount = $request->article_amount;
        $palletlabel->note = $request->note;
        $palletlabel->made_by = $authUser->first_name;
        $palletlabel->user_id = $authUser->id;
        $palletlabel->pallet_type_id = $palletType->id;
        $palletlabel->status_id = 1;
        $palletlabel->article_id = $article->id;
        $palletlabel->harvest_cycle = $request->harvest_cycle;
        $palletlabel->harvest_cycle_day = $request->harvest_cycle_day;
        $palletlabel->cell_number = $cell->number;
        $palletlabel->cell_description = $cell->description;
        $palletlabel->cell_id = $request->cell_id;


        $palletlabel->save();

        //return
        return new PalletLabelResource($palletlabel);
    }


    public function destroy($id)
    {
        $palletLabel = PalletLabel::withTrashed()->where('id', $id)->first();

        if ($palletLabel->trashed()){
            $palletLabel->restore();
        }
        else {
            $palletLabel->delete();
        }

        return new PalletLabelResource($palletLabel);
    }
}
