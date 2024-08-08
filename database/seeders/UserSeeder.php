<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker::create();

        $users = [];

        for ($i = 0; $i < 100; $i++) {
            $users[] = [
                'user_name' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123'),
                'role' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
                'active' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }

        DB::table('users')->insert($users);
    }
}
