<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission = new Permission();
        $permission->create([
            'name' => 'to_manage_tenant',
            'label' => 'Gerenciar Tenants',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
