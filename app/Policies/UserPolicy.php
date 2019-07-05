<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }


    public function view(User $user, User $model)
    {
        //dd("view");
        if($user->isModerator()){
            return true;
        }
        return false;
    }


    public function create(User $user)
    {
        //dd("create");
        return false;
    }


    public function update(User $user, User $model)
    {
        //dd("update");
        if($user->isModerator()){
            return true;
        }
        return false;
    }


    public function delete(User $user, User $model)
    {
        //dd("delete");
        if($user->isModerator()){
            return true;
        }
        return false;
    }


    public function restore(User $user, User $model)
    {
        //dd("restore");
        if($user->isModerator()){
            return true;
        }
        return false;
    }


    public function forceDelete(User $user, User $model)
    {
        dd("forceDelete");
        return false;
    }
}
