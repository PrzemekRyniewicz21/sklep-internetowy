<?php

namespace App\Providers;

use App\Enums\UserRole;
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

        $this->defineUserRole('isAdmin', UserRole::ADMIN);
        $this->defineUserRole('isUser', UserRole::USER);
        
    }

    private function defineUserRole(string $name, string $role): void {

        Gate::define($name, function(User $user) use ($role) {
            return $user->role == $role;
        });
    }
}
