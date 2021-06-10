<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * retornar todas as funções do usuário
     * relação de muitos para muitos
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * retornar todas as funções vinculadas a permissão
     */
    public function hasPermission(Permission $permissions)
    {
        return $this->hasAnyRoles($permissions->role);
    }

    /**
     * verificar se usuário tem permissão específica
     */

    public function hasAnyRoles($roles)
    {

        /*if(is_array($roles) || is_object($roles)){
            foreach ($roles as $role) {
                return $this->hasAnyRoles($role);
            }
        }*/

        // se for um array ou objeto entra aqui
        if (is_array($roles) || is_object($roles)) {
            return $roles->intersect($this->roles)->count();
        }

        // se for uma string entra aqui
        return $this->roles->contains('name', $roles);
    }
}
