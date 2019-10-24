<?php

namespace App\Policies;

use App\Event;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any event.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->hasAnyPermission(['events-list','events-create','events-edit','events-delete'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the event.
     *
     * @param  \App\User  $user
     * @param  \App\Event $event
     * @return mixed
     */
    public function view(User $user, Event $event)
    {
        if ($user->hasAnyPermission(['events-list','events-create','events-edit','events-delete'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('events-create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \App\User  $user
     * @param  \App\Event $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        if ($user->hasPermissionTo('events-edit')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\User  $user
     * @param  \App\Event $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        if ($user->hasPermissionTo('events-delete')) {
            return true;
        }
        return false;
    }
}
