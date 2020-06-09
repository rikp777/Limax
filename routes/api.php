<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API router
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', 'AuthController@login');


Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', 'AuthController@logout');
    Route::get('/authuser', 'AuthController@authUser');

    Route::apiResource('/user', 'UserController')
    ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/truck', 'TruckController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/trucker', 'TruckerController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/article', 'ArticleController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/pallettype', 'PalletTypeController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/cell', 'CellController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/role', 'RoleController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/department', 'DepartmentController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/articlefarmer', 'ArticleFarmerController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/report', 'ReportController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/logistic', 'LogisticController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/planning', 'PlanningController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/planningfast', 'PlanningFastController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/planningTotal', 'PlanningTotalController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/transport', 'TransportController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/farmer', 'FarmerController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

//    Route::post('/palletlabel/pdf/{id}', 'PalletLabelController@shippingLabelPalletLabels');
    Route::apiResource('/palletlabel', 'PalletLabelController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/palletlabelStatus', 'PalletLabelStatusController')
        ->only(['update', 'store']);

    Route::apiResource('/truckerpalletlabelStatus', 'TruckerPalletLabelStatusController')
        ->only(['update', 'store']);

    Route::apiResource('/shippinglabel', 'ShippingLabelController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/truckershippinglabel', 'TruckerShippingLabelController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::get('/cultivationcycle/calculate/{cell}', 'CultivationCycleController@calculate');



    Route::apiResource('/cultivationcycle', 'CultivationCycleController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/cultivationcycleflight', 'CultivationCycleFlightController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/palletlabelweightcheck', 'PalletLabelWeightCheckController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::apiResource('/user', 'userController')
//    ->only(['index', 'show', 'destroy', 'update', 'store']);

