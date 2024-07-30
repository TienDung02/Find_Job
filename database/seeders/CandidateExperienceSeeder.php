<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CandidateExperienceSeeder extends Seeder
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
                'candidate_id' => $faker->numberBetween(1, 50),
                'Employer' => $faker->company,
                'job_title' => $faker->jobTitle,
                'start_day' => $faker->date(),
                'end_day' => $faker->date(),
                'note' => $faker->sentence,
            ];
        }
        DB::table('candidateExperience')->insert($candidates);
    }
}
