<?php

namespace App\Policies;

use App\News;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any news.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->hasAnyPermission(['news-list','news-create','news-edit','news-delete'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the news.
     *
     * @param  \App\User $user
     * @param  \App\News $news
     * @return mixed
     */
    public function view(User $user, News $news)
    {
        if ($user->hasAnyPermission(['news-list','news-create','news-edit','news-delete'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create newss.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('news-create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the news.
     *
     * @param  \App\User $user
     * @param  \App\News $news
     * @return mixed
     */
    public function update(User $user, News $news)
    {
        if ($user->hasPermissionTo('news-edit')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  \App\User $user
     * @param  \App\News $news
     * @return mixed
     */
    public function delete(User $user, News $news)
    {
        if ($user->hasPermissionTo('news-delete')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the news.
     *
     * @param  \App\User $user
     * @param  \App\news $news
     * @return mixed
     */
    public function restore(User $user, news $news)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the news.
     *
     * @param  \App\User $user
     * @param  \App\news $news
     * @return mixed
     */
    public function forceDelete(User $user, news $news)
    {
        //
    }
}
