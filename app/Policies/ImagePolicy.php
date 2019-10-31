<?php

namespace App\Policies;

use App\Folder;
use App\Image;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\URL;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create images.
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
     * Determine whether the user can update the image.
     *
     * @param  \App\User  $user
     * @param  \App\Image  $image
     * @return mixed
     */
    public function update(User $user, Folder $folder, Image $image)
    {
        $all_staff_folders = $user->staff->folders->pluck('id')->all();

        if((in_array($folder->id, $all_staff_folders))
            && ($folder->image->imageable_id === $folder->id)
            && ($folder->image->id === $folder->image->id) 
            && ($folder->image->imageable_type == 'App\Folder')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the image.
     *
     * @param  \App\User  $user
     * @param  \App\Image  $image
     * @return mixed
     */
    public function delete(User $user, Image $image)
    {
        return true;
    }

}
