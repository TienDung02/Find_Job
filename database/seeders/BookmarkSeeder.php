<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BookmarkSeeder extends Seeder
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
        $resume_ids = DB::table('candidate_resumes')->pluck('id');
        $user_id_candidate = DB::table('users')->where('role', 2)->pluck('id');
        $user_id_employer = DB::table('users')->where('role', 3)->pluck('id');
        $blog = [];

        for ($i = 0; $i < 300; $i++) {
            if ($i%2 == 0){
                $job_id = $faker->randomElement($job_ids);
                $user_id = $faker->randomElement($user_id_candidate);
                $type_bookmark = 1;
                $createdAt_job = DB::table('jobs')->where('id', $job_id)->value('created_at');
                $createdAt_candidate = DB::table('candidates')->where('user_id', $user_id)->value('created_at');
                $closing_day = DB::table('jobs')->where('id', $job_id)->value('closing_day');
                if ($createdAt_candidate > $closing_day){
                }else {
                    if ($createdAt_candidate > $createdAt_job) {
                        $createdAt = $createdAt_candidate;
                        $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                    } else {
                        $createdAt = $createdAt_job;
                        $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                    }
                }
                $resume_id = null;
            }else{
                $resume_id = $faker->randomElement($resume_ids);
                $user_id = $faker->randomElement($user_id_employer);
                $type_bookmark = 0;
                $createdAt_resume = DB::table('candidate_resumes')->where('id', $resume_id)->value('created_at');
                $createdAt_employer = DB::table('employers')->where('user_id', $user_id)->value('created_at');
                if ($createdAt_employer > $createdAt_resume) {
                    $createdAt = $createdAt_employer;
                    $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                } else {
                    $createdAt = $createdAt_resume;
                    $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                }
                $job_id = null;
            }
            if ($i%2 !== 0 || $createdAt_candidate < $closing_day){
                $blog[] = [
                    'user_id' => $user_id,
                    'job_id' => $job_id,
                    'resume_id' => $resume_id,
                    'type_bookmark' => $type_bookmark,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
            }
        }
        DB::table('bookmarks')->insert($blog);
    }
}
