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

        for ($i = 0; $i < 50; $i++) {
            $candidates[] = [
                'candidate_id' => $faker->numberBetween(1, 50),
                'name' => $faker->name,
                'url' => $faker->url,
            ];
        }
        DB::table('candidateNetworkProfile')->insert($candidates);
    }
}
