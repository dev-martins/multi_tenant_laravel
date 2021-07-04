<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user = $user->create([
            'name' => 'Master',
            'email' => env('EMAIL_MASTER'),
            'email_verified_at' => now(),
            'password' => bcrypt(env('PASSWORD_DEFAULT')),
            'tenant_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // $user->createToken($user->email)->accessToken;
    }
}
