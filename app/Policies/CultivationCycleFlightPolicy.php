<?php

namespace App\Policies;

use App\User;
use App\CultivationCycleFlight;
use Illuminate\Auth\Access\HandlesAuthorization;

class CultivationCycleFlightPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any cultivation cycle flights.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the cultivation cycle flight.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycleFlight  $cultivationCycleFlight
     * @return mixed
     */
    public function view(User $user, CultivationCycleFlight $cultivationCycleFlight)
    {
        return false;
    }

    /**
     * Determine whether the user can create cultivation cycle flights.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the cultivation cycle flight.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycleFlight  $cultivationCycleFlight
     * @return mixed
     */
    public function update(User $user, CultivationCycleFlight $cultivationCycleFlight)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the cultivation cycle flight.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycleFlight  $cultivationCycleFlight
     * @return mixed
     */
    public function delete(User $user, CultivationCycleFlight $cultivationCycleFlight)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the cultivation cycle flight.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycleFlight  $cultivationCycleFlight
     * @return mixed
     */
    public function restore(User $user, CultivationCycleFlight $cultivationCycleFlight)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the cultivation cycle flight.
     *
     * @param  \App\User  $user
     * @param  \App\CultivationCycleFlight  $cultivationCycleFlight
     * @return mixed
     */
    public function forceDelete(User $user, CultivationCycleFlight $cultivationCycleFlight)
    {
        return false;
    }
}
