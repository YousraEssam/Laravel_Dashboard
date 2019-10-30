<?php

namespace App\Providers;

use App\City;
use App\Event;
use App\Folder;
use App\Job;
use App\News;
use App\Policies\CityPolicy;
use App\Policies\JobPolicy;
use App\Policies\RolePolicy;
use App\Policies\StaffMemberPolicy;
use App\Policies\VisitorPolicy;
use App\Policies\NewsPolicy;
use App\Policies\EventPolicy;
use App\Policies\FolderPolicy;
use App\Role;
use App\StaffMember;
use App\Visitor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        City::class => CityPolicy::class,
        Job::class => JobPolicy::class,
        Role::class => RolePolicy::class,
        StaffMember::class => StaffMemberPolicy::class,
        Visitor::class => VisitorPolicy::class,
        News::class => NewsPolicy::class,
        Event::class => EventPolicy::class,
        Folder::class => FolderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(
            function ($user, $ability) {
                return $user->hasRole('Admin') ? true : null;
            }
        );
    }
}
