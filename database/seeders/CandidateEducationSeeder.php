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
        $candidate_resume = DB::table('candidate_resumes')->pluck('id');
        $numberOfRecords =count($candidate_resume);
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $createdAt = DB::table('candidate_resumes')->where('id', $candidate_resume[$i])->value('created_at');
            $randomNumber = $faker->numberBetween(1, 3);
            for ($n = 0; $n < $randomNumber; $n ++){
                $startDay = $faker->dateTimeBetween($createdAt, 'now');
                $endDay = $faker->dateTimeBetween($startDay, 'now');
                $candidates[] = [
                    'resume_id' => $candidate_resume[$i],
                    'school_name' => $faker->company,
                    'qualification' => $faker->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
                    'start_day' => $startDay,
                    'end_day' => $endDay,
                    'note' => $faker->sentence,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
            }
        }
        DB::table('candidate_educations')->insert($candidates);
    }
}
