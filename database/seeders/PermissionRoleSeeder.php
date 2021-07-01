<?php

namespace Database\Seeders;

use App\Models\PermissionRole;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new PermissionRole();
        $permission->create([
            'permission_id' => 1,
            'role_id'       => 1,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
