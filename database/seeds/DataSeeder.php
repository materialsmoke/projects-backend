<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') === 'local') {
            DB::table('users')->insert([
                'name' => env('TEST_USER_NAME'),
                'email' => env('TEST_USER_EMAIL'),
                'password' => Hash::make(env('TEST_USER_PASSWORD')),
            ]);
            DB::table('projects')->insert([
                'user_id' => 1,
                'name' => "Test Project",
            ]);
        }
    }
}
