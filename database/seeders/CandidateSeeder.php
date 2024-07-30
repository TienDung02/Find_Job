<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $candidates = [];

        for ($i = 0; $i < 50; $i++) {
            $candidates[] = [
                'user_id' => $faker->numberBetween(1, 50),
                'avatar' => $faker->imageUrl('https://i.pravatar.cc/220'),
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
