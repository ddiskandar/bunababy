<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-settings', function (User $user) {
            return $user->isOwner();
        });

        Gate::define('manage-places', function (User $user) {
            return $user->isOwner();
        });

        Gate::define('manage-wilayah', function (User $user) {
            return $user->isOwner();
        });

        Gate::define('manage-treatments', function (User $user) {
            return $user->isOwner();
        });

        Gate::define('manage-midwives', function (User $user) {
            return $user->isOwner();
        });

        Gate::define('manage-clients', function (User $user) {
            return $user->isOwner() || $user->isAdmin();
        });

        Gate::define('manage-testimonials', function (User $user) {
            return $user->isOwner() || $user->isAdmin();
        });

        Gate::define('delete-testimonials', function (User $user) {
            return $user->isOwner();
        });

        Gate::define('manage-payments', function (User $user) {
            return $user->isOwner() || $user->isAdmin();
        });

        Gate::define('view-calendar', function (User $user) {
            return $user->isOwner() || $user->isAdmin();
        });

        Gate::define('manage-notifications', function (User $user) {
            return $user->isOwner() || $user->isAdmin();
        });

        Gate::define('delete-all-notifications', function (User $user) {
            return $user->isOwner();
        });

        Gate::define('manage-orders', function (User $user) {
            return $user->isOwner() || $user->isAdmin();
        });

        Gate::define('manage-timetables', function (User $user) {
            return $user->isOwner() || $user->isAdmin();
        });

        Gate::define('set-order-status', function (User $user) {
            return $user->isOwner() || $user->isAdmin() || $user->isMidwife();
        });
    }
}
