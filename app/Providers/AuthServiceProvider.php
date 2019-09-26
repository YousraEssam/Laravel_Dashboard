<?php

namespace App\Providers;

use App\City;
use App\Job;
use App\Policies\CityPolicy;
use App\Policies\JobPolicy;
use App\Policies\RolePolicy;
use App\Policies\StaffMemberPolicy;
use App\Role;
use App\StaffMember;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });
    }
}
