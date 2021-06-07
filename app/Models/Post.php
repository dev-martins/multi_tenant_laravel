<?php

namespace App\Models;

use App\Scopes\Tenant\TenantScope;
use Illuminate\Database\Eloquent\Model;
use App\Observers\Tenant\TenantObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'tenant_id',
    ];

    public static function boot(){
        parent::boot();
        static::addGlobalScope(new TenantScope);
        static::observe(new TenantObserver);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
