<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $faker = \Faker\Factory::create();
        $faker = Faker::create();

        // Lấy dữ liệu từ các bảng liên quan
        $categories = DB::table('categories')->pluck('id');
        $job_types = DB::table('job_types')->pluck('id');
        $job_tags = DB::table('tags')->pluck('id');
        $location = DB::table('locations')->pluck('id');

        $jobs = [];

        for ($i = 0; $i < 50; $i++) {
            $jobs[] = [
                'company_id' => $faker->numberBetween(1, 50), // Giả định có 50 employers
                'title' => $faker->jobTitle,
                'category_id' => $faker->randomElement($categories),
                'job_type_id' => $faker->randomElement($job_types),
                'location_id' => $faker->randomElement($location),
                'tag_id' => $faker->randomElement($job_tags),
                'spotlight' => null,
                'description' => $faker->paragraph,
                'job_requirements' => $faker->paragraph,
                'minimum_rate' => $faker->randomFloat(2, 15, 50),
                'maximum_rate' => $faker->randomFloat(2, 50, 100),
                'minimum_salary' => $faker->numberBetween(30000, 50000),
                'maximum_salary' => $faker->numberBetween(50000, 100000),
                'closing_day' => $faker->dateTimeBetween('now', '+1 year'),
                'apply' => $faker->boolean,
                'active' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }

        DB::table('jobs')->insert($jobs);
    }
}
