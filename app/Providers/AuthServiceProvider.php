<?php

namespace App\Providers;

use App\User;
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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $this->validateUser($user, 'admin');
        });

        Gate::define('user', function (User $user) {
            return $this->validateUser($user, 'user');
        });

        Gate::define('developer', function (User $user) {
            return $this->validateUser($user, 'developer');
        });
    }

    /**
     * Valida se o usuário logado tem permissão de acesso.
     *
     * @param User $user Usuário logado no sistema
     * @param String $type Tipo de acesso do usuário
     * @return bool Se o usuário tem permissão de acesso
     */
    private function validateUser(User $user, $type)
    {
        return ($user->accessType->type == $type )
            || $user->accessType->type == 'developer';
    }
}
