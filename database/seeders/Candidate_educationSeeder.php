<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Candidate_educationSeeder extends Seeder
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
                'id_candidate' => $faker->numberBetween(1, 50), // giả định có 50 candidates
                'school_name' => $faker->company,
                'qualification' => $faker->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
                'start_day' => $faker->date(),
                'end_day' => $faker->date(),
                'note' => $faker->sentence,
                'create_at' => now(),
                'update_at' => now(),
            ];
        }
        DB::table('candidate_educations')->insert($candidates);
    }
}
