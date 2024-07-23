<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Candidate_network_profile extends Seeder
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
                'name' => $faker->name,
                'url' => $faker->url,
                'create_at' => now(),
                'update_at' => now(),
            ];
        }
        DB::table('candidate_network_profile')->insert($candidates);
    }
}
