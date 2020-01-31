<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleFarmer;
use App\Http\Resources\ArticleFarmerResource;
use Illuminate\Http\Request;
use Request as CookieRequest;
use App\Farmer;

class ArticleFarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentFarmer = Farmer::where('uid', $request->header('authFarmer'))->first();

//        dd($currentFarmer);
//        return $currentFarmer->articles()->get();
        return ArticleFarmerResource::collection($currentFarmer->articles()->get());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {

        $farmerid = Farmer::find($request->farmerid);
        $idsArticles = array_column($request->articles, 'id');
        $tom = $farmerid->articles()->sync($idsArticles);

        $currentFarmer = Farmer::find($request->farmerid);
//        return $currentFarmer->articles()->get();
        return ArticleFarmerResource::collection($currentFarmer->articles()->get());

//        return new ArticleFarmerResource($tom);
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
