<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CandidateEducationSeeder extends Seeder
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
                'school_name' => $faker->company,
                'qualification' => $faker->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
                'start_day' => $faker->date(),
                'end_day' => $faker->date(),
                'note' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }
        DB::table('candidate_educations')->insert($candidates);
    }
}
