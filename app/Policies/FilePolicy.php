<?php

namespace App\Policies;

use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\URL;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $url = URL::full();
        $folder_id = explode('/', $url)[4];
        $all_staff_folders = $user->staff->folders->pluck('id')->all();
        if(in_array($folder_id, $all_staff_folders)){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        return true;
    }

}
