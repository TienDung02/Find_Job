<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $employer_id = DB::table('employers')->pluck('id');
        $industry_id = DB::table('industries')->pluck('id');

        $companies = [];

        for ($i = 0; $i < 50; $i++) {
            $companyName = $faker->company;
            $companies[] = [
                'employer_id' => $faker->randomElement($employer_id),
                'company_name' => $companyName,
                'company_tagline' => $faker->catchPhrase,
                'headquarters' => $faker->address,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'company_logo' => $faker->imageUrl('https://avatar.iran.liara.run/username?username='. $companyName),
                'video' => $faker->url,
                'since' => $faker->year,
                'company_website' => $faker->url,
                'email' => $faker->unique()->companyEmail,
                'phone' => $faker->phoneNumber,
                'twitter' => $faker->url,
                'facebook' => $faker->url,
                'industry_id' => $faker->randomElement($industry_id),
                'company_size' => $faker->randomElement(['Small', 'Medium', 'Large']),
                'company_average_salary' => $faker->numberBetween(40000, 120000),
                'description' => $faker->paragraph,
                'header_img' => 'https://avatar.iran.liara.run/public',
                'active' => $faker->boolean,
            ];
        }

        DB::table('companies')->insert($companies);
    }
}
