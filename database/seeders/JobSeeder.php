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

        $categories = DB::table('categories')->pluck('id');
        $job_types = DB::table('job_types')->pluck('id');
        $job_tags = DB::table('tags')->pluck('id');
        $company = DB::table('companies')->pluck('id');

        $jobs = [];

        for ($i = 0; $i < 150; $i++) {
            $company_id = $faker->randomElement($company);

            $headquarters = DB::table('companies')->where('id', $company_id)->value('headquarters');

            $province = DB::table('companies')->where('id', $company_id)->value('province_id');
            $district = DB::table('companies')->where('id', $company_id)->value('district_id');
            $ward = DB::table('companies')->where('id', $company_id)->value('ward_id');

            $province_name = DB::table('provinces')->where('id', $province)->value('name');
            $district_name = DB::table('districts')->where('id', $district)->value('name');
            $ward_name = DB::table('wards')->where('id', $ward)->value('name');

            $createdAt = DB::table('companies')->where('id', $company_id)->value('created_at');
            $createdAt = $faker->dateTimeBetween($createdAt, 'now');
            $closing_day = $faker->dateTimeBetween($createdAt, '+30 days');

            $day = $faker->numberBetween(1, 30);
            $munber_tag = $faker->numberBetween(1, 5);
            $selected_tag_ids = $faker->randomElements($job_tags, $munber_tag);
            $tag_ids_string = implode(', ', $selected_tag_ids);

            $type_salary = $faker->randomElement(['1', '2', '3']);
            if ($type_salary == 1){
                $minimum_salary = $faker->numberBetween(3000, 5000);
                $maximum_salary = $faker->numberBetween(5000, 10000);
                $salary = null;
            }elseif ($type_salary == 2){
                $minimum_salary = null;
                $maximum_salary = null;
                $salary = $faker->numberBetween(3000, 10000);
            }else{
                $minimum_salary = null;
                $maximum_salary = null;
                $salary = null;
            }
            if ($i < 15){
                $spotlight = date('Y-m-d', strtotime('+'.$day.' day'));
            }else{
                $spotlight = null;
            }
            $jobs[] = [
                'company_id' => $company_id,
                'title' => $faker->jobTitle,
                'category_id' => $faker->randomElement($categories),
                'job_type_id' => $faker->randomElement($job_types),
                'province_id' => $province,
                'district_id' => $district,
                'ward_id' => $ward,
                'location' => $province_name . ', ' . $district_name . ', ' . $ward_name . ', ' . $headquarters,
                'tag_id' => $tag_ids_string,
                'spotlight' => $spotlight,
                'description' => $faker->paragraph,
                'benefit' => $faker->paragraph,
                'job_requirements' => $faker->paragraph,
                'type_salary' => $type_salary,
                'salary' => $salary,
                'minimum_salary' => $minimum_salary,
                'maximum_salary' => $maximum_salary,
                'closing_day' => $closing_day,
                'active' => $faker->boolean,
                'fill' => $faker->boolean,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];
        }

        DB::table('jobs')->insert($jobs);
    }
}
