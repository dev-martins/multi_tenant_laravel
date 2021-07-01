<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new RoleUser();
        $role->create([
            'role_id'   => 1,
            'user_id'    => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
