<?php

namespace App\Policies;

use App\Folder;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\URL;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any folder.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if($user->can('folder-add')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the folder.
     *
     * @param  \App\User        $user
     * @param  \App\Folder $folder
     * @return mixed
     */
    public function view(User $user, Folder $folder)
    {
        $all = $user->staff->folders->pluck('id')->all();
        if($user->can('folder-add') && in_array($folder->id, $all)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create folders.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('folder-add')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the folder.
     *
     * @param  \App\User        $user
     * @param  \App\Folder $folder
     * @return mixed
     */
    public function update(User $user, Folder $folder)
    {
        $all_staff_folders = $user->staff->folders->pluck('id')->all();

        if($user->hasPermissionTo('folder-add') && (in_array($folder->id, $all_staff_folders)) ){

            if( explode('/', URL::full())[5] == 'images' ){
                if(    ($folder->image->imageable_id == $folder->id)
                    && ($folder->image->id == $folder->image->id) 
                    && ($folder->image->imageable_type == 'App\Folder')){
                        return true;
                    }else{
                        return false;
                    }
                }elseif( explode('/', URL::full())[5] == 'files' ){
                if(    ($folder->file->fileable_id == $folder->id)
                    && ($folder->file->id == $folder->file->id) 
                    && ($folder->file->fileable_type == 'App\Folder')){
                        return true;
                    }else{
                        return false;
                    }
                }elseif( explode('/', URL::full())[5] == 'videos' ){
                if(    ($folder->video->videoable_id == $folder->id)
                    && ($folder->video->id == $folder->video->id) 
                    && ($folder->video->videoable_type == 'App\Folder')){
                        return true;
                }else{
                    return false;
                }
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the staff member.
     *
     * @param  \App\User        $user
     * @param  \App\Folder $folder
     * @return mixed
     */
    public function delete(User $user,  Folder $folder)
    {
        $all = $user->staff->folders->pluck('id')->all();
        if($user->hasPermissionTo('folder-add') && in_array($folder->id, $all)) {
            return true;
        }
        return false;
    }
}
