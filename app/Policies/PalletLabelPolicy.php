<?php

namespace App\Policies;

use App\User;
use App\PalletLabel;
use Illuminate\Auth\Access\HandlesAuthorization;

class PalletLabelPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any pallet labels.
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
     * Determine whether the user can view the pallet label.
     *
     * @param  \App\User  $user
     * @param  \App\PalletLabel  $palletLabel
     * @return mixed
     */
    public function view(User $user, PalletLabel $palletLabel)
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
     * Determine whether the user can create pallet labels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
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
     * Determine whether the user can update the pallet label.
     *
     * @param  \App\User  $user
     * @param  \App\PalletLabel  $palletLabel
     * @return mixed
     */
    public function update(User $user, PalletLabel $palletLabel)
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
     * Determine whether the user can delete the pallet label.
     *
     * @param  \App\User  $user
     * @param  \App\PalletLabel  $palletLabel
     * @return mixed
     */
    public function delete(User $user, PalletLabel $palletLabel)
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
     * Determine whether the user can restore the pallet label.
     *
     * @param  \App\User  $user
     * @param  \App\PalletLabel  $palletLabel
     * @return mixed
     */
    public function restore(User $user, PalletLabel $palletLabel)
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
     * Determine whether the user can permanently delete the pallet label.
     *
     * @param  \App\User  $user
     * @param  \App\PalletLabel  $palletLabel
     * @return mixed
     */
    public function forceDelete(User $user, PalletLabel $palletLabel)
    {
        if($user->isModerator()){
            return true;
        }
        if($user->isFarmer()){
            return true;
        }
        return false;
    }
}
