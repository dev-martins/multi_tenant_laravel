<?php

namespace App\Providers;

use App\Models\User;
// use App\Models\Post;
// use App\Policies\PostPolicy;
use App\Models\Permission;
use Laravel\Passport\Passport;
use Illuminate\Auth\Access\Response;
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
        // Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = Permission::with('roles')->get();
        foreach ($permissions as $permission) {

            Gate::define($permission->name, function ($user) use ($permission) {

                return $user->hasPermission($permission)
                    ? Response::allow()
                    : Response::deny('Sua função não permite executar essa ação!', 403);
            });

            //primeira verificação
            Gate::before(function (User $user, $ability) {
                if ($user->hasAnyRoles('Admin')) {
                    return true;
                }
            });
        }

        Passport::routes();
    }
}
