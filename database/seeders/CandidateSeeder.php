<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CandidateSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $candidates = [];
        $user_id = DB::table('users')->where('role', 2)->pluck('id');
        $numberOfRecords =count($user_id);
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $createdAt = DB::table('users')->where('id', $user_id[$i])->value('created_at');

            $rating = $faker->randomFloat(1, 1, 5);

            $candidates[] = [
                'user_id' => $user_id[$i],

                'tel' => $faker->phoneNumber,
                'about' => $faker->sentence,
                'active' => $faker->boolean,
                'rating' => $rating,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];
        }
        DB::table('candidates')->insert($candidates);
    }
}
