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
        $categories = DB::table('categories')->pluck('id_category');
        $job_types = DB::table('job_type')->pluck('id_job_type');
        $job_tags = DB::table('tags')->pluck('tag_id');
        $location = DB::table('location')->pluck('id_location');

        $jobs = [];

        for ($i = 0; $i < 50; $i++) {
            $jobs[] = [
                'id_employer' => $faker->numberBetween(1, 50), // Giả định có 50 employers
                'title' => $faker->jobTitle,
                'category' => $faker->randomElement($categories),
                'job_type' => $faker->randomElement($job_types),
                'location' => $faker->randomElement($location),
                'job_tag' => $faker->randomElement($job_tags),
                'description' => $faker->paragraph,
                'job_requirements' => $faker->paragraph,
                'minimum_rate' => $faker->randomFloat(2, 15, 50),
                'maximum_rate' => $faker->randomFloat(2, 50, 100),
                'minimum_salary' => $faker->numberBetween(30000, 50000),
                'maximum_salary' => $faker->numberBetween(50000, 100000),
                'closing_day' => $faker->dateTimeBetween('now', '+1 year'),
                'apply' => $faker->boolean,
                'active' => $faker->boolean,
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('jobs')->insert($jobs);
    }
}
