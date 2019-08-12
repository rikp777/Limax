<?php

namespace App\Policies;

use App\Farmer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FarmerPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if($user->isModerator()){
            return true;
        }
        if($user->isFarmer()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function view(User $user, Farmer $farmer)
    {
        if($user->isModerator()){
            return true;
        }
        if($user->isFarmer()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->isModerator()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function update(User $user, Farmer $farmer)
    {
        if($user->isModerator()){
            return true;
        }
        if($user->id === $farmer->user_id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function delete(User $user, Farmer $farmer)
    {
        if($user->isModerator()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function restore(User $user, Farmer $farmer)
    {
        if($user->isModerator()){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function forceDelete(User $user, Farmer $farmer)
    {
        if($user->isModerator()){
            return true;
        }
        return false;
    }
}
