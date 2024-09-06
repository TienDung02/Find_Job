<?php

namespace Database\Seeders;

use App\Models\Employer;
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
        $candidate_resume = DB::table('candidate_resumes')->pluck('id');
        $employer_id = DB::table('employers')->pluck('id');
        $numberOfRecords =count($candidate_resume);
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $createdAt = DB::table('candidate_resumes')->where('id', $candidate_resume[$i])->value('created_at');
            $randomNumber = $faker->numberBetween(1, 3);
            for ($n = 0; $n < $randomNumber; $n ++){
                $startDay = $faker->dateTimeBetween($createdAt, 'now');
                $endDay = $faker->dateTimeBetween($startDay, 'now');
                $employer = DB::table('companies')->pluck('company_name');
                $candidates[] = [
                    'resume_id' => $candidate_resume[$i],
                    'employer' => $faker->randomElement($employer),
                    'job_title' => $faker->jobTitle,
                    'start_day' => $startDay,
                    'end_day' => $endDay,
                    'note' => $faker->sentence,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
            }
        }
        DB::table('candidate_experiences')->insert($candidates);
    }
}
