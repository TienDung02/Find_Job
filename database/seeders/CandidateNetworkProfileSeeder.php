<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CandidateNetworkProfileSeeder extends Seeder
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
            for ($n = 0; $n < $randomNumber ; $n++){
                $candidates[] = [
                    'resume_id' => $faker->numberBetween(1, 50),
                    'name' => $faker->domainName,
                    'url' => $faker->url,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
            }
        }
        DB::table('candidate_Network_Profiles')->insert($candidates);
    }
}
