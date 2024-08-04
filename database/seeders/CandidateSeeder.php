<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CandidateSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $candidates = [];

        for ($i = 0; $i < 50; $i++) {
            $candidates[] = [
                'user_id' => $faker->numberBetween(1, 50),
                'avatar' => 'https://avatar.iran.liara.run/public',
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'tel' => $faker->phoneNumber,
                'about' => $faker->sentence,
                'active' => $faker->boolean,

            ];
        }
        DB::table('candidates')->insert($candidates);
    }
}
