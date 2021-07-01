<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->create([
            'name' => 'Manager_Tenant',
            'label' => 'Gerente dos tenants do sistema',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
