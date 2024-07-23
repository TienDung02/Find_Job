<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Candidate_experienceSeeder extends Seeder
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
                'Employer' => $faker->company,
                'job_title' => $faker->jobTitle,
                'start_day' => $faker->date(),
                'end_day' => $faker->date(),
                'note' => $faker->sentence,
                'create_at' => now(),
                'update_at' => now(),
            ];
        }
        DB::table('candidate_experience')->insert($candidates);
    }
}
