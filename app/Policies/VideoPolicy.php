<?php

namespace App\Policies;

use App\User;
use App\Video;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\URL;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create videos.
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
     * Determine whether the user can update the video.
     *
     * @param  \App\User  $user
     * @param  \App\Video  $video
     * @return mixed
     */
    public function update(User $user, Video $video)
    {
        //
    }

    /**
     * Determine whether the user can delete the video.
     *
     * @param  \App\User  $user
     * @param  \App\Video  $video
     * @return mixed
     */
    public function delete(User $user, Video $video)
    {
        //
    }

}
