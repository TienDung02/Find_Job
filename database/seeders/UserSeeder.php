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

        for ($i = 0; $i < 50; $i++) {
            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            if ($i < 8){
                $role = $faker->randomElement([1, 4, 5, 6, 7, 8]);
            }else{
                $role = $faker->randomElement([2, 3]);
            }
            $user_name = $faker->userName;
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $users[] = [
                'user_name' => $user_name,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $faker->unique()->safeEmail,
                'avatar' => 'https://avatar.iran.liara.run/username?username='. $firstName . ' ' . $lastName,
                'password' => Hash::make('123'),
                'role' => $role,
                'active' => $faker->boolean,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];
        }

        DB::table('users')->insert($users);
    }
}
