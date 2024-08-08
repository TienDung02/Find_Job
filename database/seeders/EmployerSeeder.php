<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user_id = DB::table('users')->where('role', 3)->pluck('id');
        $numberOfRecords =count($user_id);
        $employer = [];

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $employer[] = [
                'user_id' => $user_id[$i],
                'avatar' => 'https://i.pravatar.cc/150',
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'tel' => $faker->phoneNumber,
                'about' => $faker->sentence,
                'active' => $faker->boolean,
                'free_jobs_count' => 3,
                'job_package' => null,
                'package_expiration' => null,
                'jobs_remaining' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null

            ];
        }

        DB::table('employers')->insert($employer);
    }
}
