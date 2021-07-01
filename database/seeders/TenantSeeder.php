<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = new Tenant;
        $tenant->create([
            'name' => 'Master',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
