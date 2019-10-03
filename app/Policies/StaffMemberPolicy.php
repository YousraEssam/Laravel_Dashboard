<?php

namespace App\Policies;

use App\User;
use App\StaffMember;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffMemberPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any staff members.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // if ($user->hasAnyPermission(['staffmember-list', 'staffmember-list','staffmember-create','staffmember-edit','staffmember-delete'])) 
        if($user->can('staffmember-list') || $user->can('staffmember-create') || $user->can('staffmember-edit') || $user->can('staffmember-delete')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the staff member.
     *
     * @param  \App\User        $user
     * @param  \App\StaffMember $staffMember
     * @return mixed
     */
    public function view(User $user, StaffMember $staffMember)
    {
        if ($user->hasAnyPermission(['staffmember-list','staffmember-create','staffmember-edit','staffmember-delete'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create staff members.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('staffmember-create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the staff member.
     *
     * @param  \App\User        $user
     * @param  \App\StaffMember $staffMember
     * @return mixed
     */
    public function update(User $user, StaffMember $staffMember)
    {
        if ($user->hasPermissionTo('staffmember-edit')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the staff member.
     *
     * @param  \App\User        $user
     * @param  \App\StaffMember $staffMember
     * @return mixed
     */
    public function delete(User $user, StaffMember $staffMember)
    {
        if ($user->hasPermissionTo('staffmember-delete')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the staff member.
     *
     * @param  \App\User        $user
     * @param  \App\StaffMember $staffMember
     * @return mixed
     */
    public function restore(User $user, StaffMember $staffMember)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the staff member.
     *
     * @param  \App\User        $user
     * @param  \App\StaffMember $staffMember
     * @return mixed
     */
    public function forceDelete(User $user, StaffMember $staffMember)
    {
        //
    }
}
