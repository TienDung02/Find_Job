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
            $createdAt = DB::table('users')->where('id', $user_id[$i])->value('created_at');
            $employer[] = [
                'user_id' => $user_id[$i],
                'tel' => $faker->phoneNumber,
                'about' => $faker->sentence,
                'active' => $faker->boolean,
                'free_jobs_count' => 3,
                'job_package' => null,
                'package_expiration' => null,
                'jobs_remaining' => null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null

            ];
        }

        DB::table('employers')->insert($employer);
    }
}
