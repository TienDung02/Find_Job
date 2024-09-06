<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ApplyJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $job_ids = DB::table('jobs')->pluck('id');
        $candidate_ids = DB::table('users')->where('role', 2)->pluck('id');

        $blog = [];

        for ($i = 0; $i < 300; $i++) {
            $job_id = $faker->randomElement($job_ids);
            $job = Job::find($job_id);
            $candidate_id = $faker->randomElement($candidate_ids);
            $createdAt_job = DB::table('jobs')->where('id', $job_id)->value('created_at');
            $createdAt_candidate = DB::table('candidates')->where('user_id', $candidate_id)->value('created_at');
            $closing_day = DB::table('jobs')->where('id', $job_id)->value('closing_day');

            if ($createdAt_candidate > $closing_day) {
                continue;
            } else {
                if ($createdAt_candidate > $createdAt_job) {
                    $createdAt = $createdAt_candidate;
                    $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                } else {
                    $createdAt = $createdAt_job;
                    $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                }

                $blog[] = [
                    'job_id' => $job_id,
                    'company_id' => $job->company->id,
                    'user_id' => $candidate_id,
                    'full_name' => $faker->name,
                    'email' => $faker->email,
                    'message' => $faker->text,
                    'cv' => $faker->text,
                    'note' => $faker->text,
                    'rating' => null,
                    'status_id' => $faker->numberBetween(1, 5),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
            }
        }

        DB::table('apply_jobs')->insert($blog);
    }

}
