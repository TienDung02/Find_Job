<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user_id = DB::table('users')->pluck('id');


        $employer = [];

        for ($i = 0; $i < 50; $i++) {
            $employer[] = [
                'user_id' => $faker->randomElement($user_id),
                'avatar' => $faker->imageUrl('https://avatar.iran.liara.run/public'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'tel' => $faker->phoneNumber,
                'about' => $faker->sentence,
                'active' => $faker->boolean,

            ];
        }

        DB::table('employers')->insert($employer);
    }
}
