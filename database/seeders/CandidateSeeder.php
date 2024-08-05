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
            $candidates[] = [
                'user_id' => $user_id[$i],
                'avatar' => 'https://avatar.iran.liara.run/public',
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'tel' => $faker->phoneNumber,
                'about' => $faker->sentence,
                'active' => $faker->boolean,

            ];
        }
        DB::table('candidates')->insert($candidates);
    }
}
