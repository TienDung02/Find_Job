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

        $id_employer = DB::table('employers')->pluck('id_employer');
        $id_industry = DB::table('industries')->pluck('id_industry');

        $companies = [];

        for ($i = 0; $i < 50; $i++) {
            $companies[] = [
                'id_employer' => $faker->randomElement($id_employer), // Giả định có 50 employers
                'company_name' => $faker->company,
                'company_tagline' => $faker->catchPhrase,
                'headquarters' => $faker->address,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'company_logo' => $faker->imageUrl(200, 200, 'business', true, 'Faker'), // URL ảnh logo giả
                'video' => $faker->url,
                'since' => $faker->year,
                'company_website' => $faker->url,
                'email' => $faker->unique()->companyEmail,
                'phone' => $faker->phoneNumber,
                'twitter' => $faker->url,
                'facebook' => $faker->url,
                'id_industry' => $faker->randomElement($id_industry),
                'company_size' => $faker->randomElement(['Small', 'Medium', 'Large']),
                'company_average_salary' => $faker->numberBetween(40000, 120000),
                'description' => $faker->paragraph,
                'header_img' => $faker->imageUrl(800, 200, 'business', true, 'Faker'), // URL ảnh header giả
                'active' => $faker->boolean,
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('companies')->insert($companies);
    }
}
