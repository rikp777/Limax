<?php

namespace App\Policies;

use App\User;
use App\CultivationCycle;
use Illuminate\Auth\Access\HandlesAuthorization;

class CultivationCyclePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any cultivation cycles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the cultivation cycle.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycle  $cultivationCycle
     * @return mixed
     */
    public function view(User $user, CultivationCycle $cultivationCycle)
    {
        return false;
    }

    /**
     * Determine whether the user can create cultivation cycles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the cultivation cycle.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycle  $cultivationCycle
     * @return mixed
     */
    public function update(User $user, CultivationCycle $cultivationCycle)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the cultivation cycle.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycle  $cultivationCycle
     * @return mixed
     */
    public function delete(User $user, CultivationCycle $cultivationCycle)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the cultivation cycle.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycle  $cultivationCycle
     * @return mixed
     */
    public function restore(User $user, CultivationCycle $cultivationCycle)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the cultivation cycle.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycle  $cultivationCycle
     * @return mixed
     */
    public function forceDelete(User $user, CultivationCycle $cultivationCycle)
    {
        return false;
    }
}
