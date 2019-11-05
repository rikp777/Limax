<?php

namespace App\Http\Controllers;


use App\Article;
use App\Cell;
use App\CultivationCycle;
use App\Farmer;
use App\Http\Resources\PalletLabelResource;
use App\PalletLabel;
use App\PalletType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use Illuminate\Routing\Route;

class PalletLabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(PalletLabel::class, 'App\PalletLabel'); //BugFix
    }


    public function index()
    {
        return PalletLabelResource::collection(PalletLabel::paginate(15));
    }


    public function store(Request $request)
    {
        $request->validate([
            'crop_date' => 'required|date',
            'article_amount' => 'required|int',
            'article_id' => 'required',
            'pallet_type_id' => 'required',
            'cell_id' => 'required|int',
            'note' => 'max:500',
        ]);

        $authUser = auth()->user();
        $currentFarmer = Farmer::getCurrentFarmer();
        $article = Article::findOrFail($request->article_id);
        $palletType = PalletType::findOrFail($request->pallet_type_id);
        $cell = Cell::findOrFail($request->cell_id);


        //Consume own cultivation api

        $apiUrlCall = '/api/cultivationcycle/calculate/' . $cell->id;
        $cultivationCycleReqeust = Request::create($apiUrlCall, 'GET');
        $cultivationCycleContent = Route::dispatch($cultivationCycleReqeust)->getContent();
        $cultivationCycleCalculation = json_decode($cultivationCycleContent, TRUE);
//        dd($cultivationCycleCalculation);
//        dd($cultivationCycleCalculation['data']['raw_data']['cultivation_cycle']['id']);


        if (!empty($cultivationCycleCalculation)) {
            $cultivationCycle = CultivationCycle::findOrFail($cultivationCycleCalculation['data']['raw_data']['cultivation_cycle']['id']);
            if ($cultivationCycleCalculation['data']['calculation']['error']) {
                if ($cultivationCycleCalculation['data']['calculation']['harvest_cycle'] == 1) {


                    $newCycle = new CultivationCycle();
                    $newCycle->cell_description = $cultivationCycle->cell->id . ' - ' . $cultivationCycle->cell->description;
                    $newCycle->farmer_id = $currentFarmer->id;
                    $newCycle->fill_date = Carbon::now()->subDays(14)->toDateTimeString();
                    $newCycle->article_group_id = $article->article_group_id;
                    $newCycle->save();

                    $newCycleDate = new CultivationCycleFlight();
                    $newCycleDate->date = Carbon::now();;
                    $newCycleDate->cultivation_cycle_id = $newCycle->id;
                    $newCycleDate->save();


                } else if ($cultivationCycleCalculation['data']['calculation']['harvest_cycle'] > 1) {


                    $newCycleDate = new CultivationCycleFlight();
                    $newCycleDate->date = Carbon::now()->toDateTimeString();
                    $newCycleDate->cultivation_cycle_id = $cultivationCycle->id;
                    $newCycleDate->save();


                }
            }
        }
        // =====================================================


        // reload data
        //Consume own cultivation api

        $apiUrlCall = '/api/cultivationcycle/calculate/' . $cell->id;
        $cultivationCycleReqeust = Request::create($apiUrlCall, 'GET');
        $cultivationCycleContent = Route::dispatch($cultivationCycleReqeust)->getContent();
        $cultivationCycleCalculation = json_decode($cultivationCycleContent, TRUE);


        //autoincrement unique palletlabel farmer id
        $palletlabelFarmerId = 0;
        $palletlabelFarmer = Palletlabel::where('farmer_id', $currentFarmer->id)->orderby('id', 'desc')->first();
        if ($palletlabelFarmer) {
            $palletlabelFarmerId = $palletlabelFarmer->pallet_label_farmer_id + 1;
        }


        //insert palletLabel
        $palletlabel = new Palletlabel();
        $palletlabel->crop_date = Carbon::parse($request->crop_date);
        $palletlabel->crop_date = Carbon::parse($request->crop_date);
        $palletlabel->article_amount = $request->article_amount;
        $palletlabel->note = $request->note;
        $palletlabel->pallet_label_farmer_id = $palletlabelFarmerId;
        $palletlabel->made_by = $authUser->first_name;
        $palletlabel->user_id = $authUser->id;
        $palletlabel->farmer_id = $currentFarmer->id;
        $palletlabel->pallet_type_id = $palletType->id;
        $palletlabel->status_id = 1;
        $palletlabel->article_id = $article->id;
        $palletlabel->cultivation_cycle_id = $cultivationCycleCalculation['data']['raw_data']['cultivation_cycle']['id'];
        $palletlabel->harvest_cycle = $cultivationCycleCalculation['data']['calculation']['harvest_cycle'];
        $palletlabel->harvest_cycle_day = $cultivationCycleCalculation['data']['calculation']['harvest_cycle_day'];
        $palletlabel->cell_number = $cultivationCycleCalculation['data']['raw_data']['cell']['number'];
        $palletlabel->cell_description = $cultivationCycleCalculation['data']['raw_data']['cell']['description'];
        $palletlabel->cell_id = $cultivationCycleCalculation['data']['raw_data']['cell']['id'];
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
        $request->validate([
            'crop_date' => 'required|date',
            'article_amount' => 'required|int',
            'article_id' => 'required|int',
            'pallet_type_id' => 'required|int',
            'cell_id' => 'required|int',
            'note' => 'max:500',
        ]);

        $authUser = auth()->user();
        $currentFarmer = Farmer::getCurrentFarmer();
        $article = Article::findOrFail($request->article_id);
        $palletType = PalletType::findOrFail($request->pallet_type_id);
        $cell = Cell::findOrFail($request->cell_id);


        //Consume own cultivation api
        $apiUrlCall = '/api/cultivationcycle/' . $cell->id;
        $cultivationCycleReqeust = Request::create($apiUrlCall, 'GET');
        $cultivationCycleContent = Route::dispatch($cultivationCycleReqeust)->getContent();
        $cultivationCycleCalculation = json_decode($cultivationCycleContent);


        if (!isset($request->cultivation_cycle_id)) {
            if (!empty($cultivationCycleCalculation)) {
                $cultivationCycle = CultivationCycle::findOrFail($cultivationCycleCalculation->raw_data->cultivation_id);
                if ($cultivationCycleCalculation->error) {
                    if ($cultivationCycleCalculation->flight == 1) {


                        $newCycle = new CultivationCycle();
                        $newCycle->cell_description = $cultivationCycle->cell->id . ' - ' . $cultivationCycle->cell->description;
                        $newCycle->farmer_id = $currentFarmer->id;
                        $newCycle->fill_date = Carbon::now()->subDays(14)->toDateTimeString();
                        $newCycle->article_group_id = $article->article_group_id;
                        $newCycle->save();

                        $newCycleDate = new CultivationCycleFlight();
                        $newCycleDate->date = Carbon::now();;
                        $newCycleDate->cultivation_cycle_id = $newCycle->id;
                        $newCycleDate->save();


                    } else if ($cultivationCycleCalculation->flight > 1) {


                        $newCycleDate = new CultivationCycleFlight();
                        $newCycleDate->date = Carbon::now()->toDateTimeString();
                        $newCycleDate->cultivation_cycle_id = $cultivationCycle->id;
                        $newCycleDate->save();


                    }
                }
            }
            // =====================================================

            // reload data
            //Consume own cultivation api
            $apiUrlCall = '/api/cultivationcycle/' . $cell->id;
            $cultivationCycleReqeust = Request::create($apiUrlCall, 'GET');
            $cultivationCycleContent = Route::dispatch($cultivationCycleReqeust)->getContent();
            $cultivationCycleCalculation = json_decode($cultivationCycleContent);
        }



        //dd($cultivationCycleCalculation);
        //autoincrement unique palletlabel farmer id
        $palletlabelFarmerId = 0;
        $palletlabelFarmer = Palletlabel::where('farmer_id', $currentFarmer->id)->orderby('id', 'desc')->first();
        if ($palletlabelFarmer) {
            $palletlabelFarmerId = $palletlabelFarmer->pallet_label_farmer_id + 1;
        }


        //insert palletLabel
        $palletlabel = Palletlabel::where('farmer_id', $currentFarmer->id)->where('id', $id)->first();
        $palletlabel->crop_date = Carbon::parse($request->crop_date);
        $palletlabel->article_amount = $request->article_amount;
        $palletlabel->note = $request->note;
        $palletlabel->pallet_label_farmer_id = $palletlabelFarmerId;
        $palletlabel->made_by = $authUser->first_name;
        $palletlabel->user_id = $authUser->id;
        $palletlabel->pallet_type_id = $palletType->id;
        $palletlabel->status_id = 1;
        $palletlabel->article_id = $article->id;

        if (!isset($request->cultivation_cycle_id)) {
            $palletlabel->cultivation_cycle_id = $cultivationCycleCalculation->raw_data->cultivation_id;
            $palletlabel->harvest_cycle = $cultivationCycleCalculation->flight;
            $palletlabel->harvest_cycle_day = $cultivationCycleCalculation->flight_day;
            $palletlabel->cell_number = $cultivationCycleCalculation->cell;
            $palletlabel->cell_description = $cultivationCycleCalculation->cell_description;
        }


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
