<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        for ($i = 0; $i < 50; $i++) {
            $users[] = [
                'user_name' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => md5('123'),
                'role' => $faker->randomElement([1, 2, 3]),
                'active' => $faker->boolean,
            ];
        }

        DB::table('user')->insert($users);
    }
}
