<?php

namespace App\Traits;


use App\Scopes\Tenant\TenantScope;
use App\Observers\Tenant\TenantObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait TenantTrait
{
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TenantScope);
        static::observe(new TenantObserver);
    }
}
