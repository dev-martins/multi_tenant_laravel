<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TenantSeeder;
use Database\Seeders\RoleUserSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\PermissionRoleSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        $this->call([
            TenantSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleUserSeeder::class,
            PermissionRoleSeeder::class
        ]);
    }
}
