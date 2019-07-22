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


    Route::apiResource('/user', 'userController')
    ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/article', 'ArticleController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/pallettype', 'PalletTypeController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);
    Route::apiResource('/cell', 'CellController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/palletlabel', 'PalletLabelController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::get('/cultivationCycle/calculate/{cell}', 'CultivationCycleController@calculate');
    Route::apiResource('/cultivationCycle', 'CultivationCycleController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);

    Route::apiResource('/cultivationCycleFlight', 'CultivationCycleFlightController')
        ->only(['index', 'show', 'destroy', 'update', 'store']);
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::apiResource('/user', 'userController')
//    ->only(['index', 'show', 'destroy', 'update', 'store']);

