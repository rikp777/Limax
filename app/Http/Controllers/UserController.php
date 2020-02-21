<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'App\User');

    }

    public function index()
    {
        return UserResource::collection(User::get());
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|min:2|max:25',
            'insert_name' => 'string|max:10',
            'last_name' => 'required|string|min:2|max:35',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $request->request->add(['uid' => Str::uuid()->toString()]);
        $request->request->add(['password' => Hash::make($request->password)]);


//        dd($request->all());
        $user = User::create($request->all());

//        $user->roles()->sync($request->roles);
//        $user->departments()->sync($request->departments);

        $user->roles()->sync($request['roles']['id']);

        $idsDepartments = array_column($request->departments, 'id');

        $user->departments()->sync($idsDepartments);

        $idsFarmers = array_column($request->farmers, 'id');
        $user->farmers()->sync($idsFarmers);


        return new UserResource($user);
    }


    public function show(User $user) : UserResource
    {
        return new userResource($user);
    }


    public function update(User $user, Request $request) : UserResource
    {
//        dd($request->all());
//        dd($user->id);
        $request->validate([
            'first_name' => 'required|string|min:2|max:25',
            'last_name' => 'required|string|min:2|max:35',
            'email' => 'required|email|max:255'. $user->id,
        ]);
//        $request->request->add(['password' => Hash::make($request->password)]);


        $user->update($request->all());

//        $idsRoles = $request->roles;
//        dd($request['roles']['id']);
        $user->roles()->sync($request['roles']['id']);

        $idsDepartments = array_column($request->departments, 'id');
//        dd($idsDepartments);
        $user->departments()->sync($idsDepartments);

        $idsFarmers = array_column($request->farmers, 'id');
        $user->farmers()->sync($idsFarmers);

        return new userResource($user);
    }


    public function destroy($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        if ($user->trashed()){
            $user->restore();
        }
        else {
            $user->delete();
        }
        return new UserResource($user);
    }
}
