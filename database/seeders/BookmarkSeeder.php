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
        $job_id = DB::table('jobs')->pluck('id');
        $candidate_id = DB::table('candidates')->pluck('id');
        $blog = [];

        for ($i = 0; $i < 20; $i++) {
            $blog[] = [
                'candidate_id' => $faker->randomElement($candidate_id),
                'job_id' => $faker->randomElement($job_id),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }
        DB::table('bookmarks')->insert($blog);
    }
}
