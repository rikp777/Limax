<?php

namespace App\Http\Controllers;

use App\Http\Resources\TruckerResource;
use App\Http\Resources\UserResource;
use App\Truck;
use App\User;
use Illuminate\Http\Request;

class TruckerController extends Controller
{
    public function index()
    {
        //TODO
        //QUICK FIX users in truck
        //fix in future pls
        $usersinTruck = Truck::with('user')->get();
        $users = [];
        foreach ($usersinTruck as $item) {
            array_push($users, $item['user']);
        }

        return UserResource::collection(collect($users));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
