<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-as-super-admin', function (User $user) {
            return $user->user_level_label === 'super admin';
        });

        Gate::define('view-as-admin', function (User $user) {
            return in_array($user->user_level_label, ['admin', 'super admin']);
        });

        Gate::define('view-as-user', function (User $user) {
            return $user->user_level_label === 'user';
        });

        Gate::define('update-user', function (User $currentUser, User $targetUser) {
            if ($targetUser->user_level_label === 'super admin' && $currentUser->id === $targetUser->id) {
                return false;
            }

            return $currentUser->user_level_label === 'super admin';
        });
    }
}
