<?php

namespace App\Policies;

use App\User;
use App\City;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any cities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->hasAnyPermission(['city-list','city-create','city-edit','city-delete'])) 
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function view(User $user, City $city)
    {
        if ($user->hasAnyPermission(['city-list','city-create','city-edit','city-delete'])) 
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create cities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('city-create'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function update(User $user, City $city)
    {
        if ($user->hasPermissionTo('city-edit'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function delete(User $user, City $city)
    {
        if ($user->hasPermissionTo('city-delete'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function restore(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the city.
     *
     * @param  \App\User  $user
     * @param  \App\City  $city
     * @return mixed
     */
    public function forceDelete(User $user, City $city)
    {
        //
    }
}
