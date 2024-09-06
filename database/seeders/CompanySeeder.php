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
        $province_id = DB::table('provinces')->pluck('id');
        $numberOfRecords =count($employer_id);
        $companies = [];

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $companyName = $faker->company;

            $province = $faker->randomElement($province_id);

            $district = $faker->randomElement(DB::table('districts')->where('province_id', $province)->pluck('id'));

            $wards = $faker->randomElement(DB::table('wards')->where('district_id', $district)->pluck('id'));

            $createdAt = DB::table('employers')->where('id', $employer_id[$i])->value('created_at');
            $createdAt = $faker->dateTimeBetween($createdAt, 'now');
            $companies[] = [
                'employer_id' => $employer_id[$i],
                'company_name' => $companyName,
                'company_tagline' => $faker->catchPhrase,
                'province_id' => $province,
                'district_id' => $district,
                'ward_id' => $wards,
                'headquarters' => $faker->address,
                'company_logo' => 'https://avatar.iran.liara.run/username?username='. $companyName,
                'company_website' => $faker->url,
                'email' => $faker->unique()->companyEmail,
                'phone' => $faker->phoneNumber,
                'twitter' => $faker->url,
                'facebook' => $faker->url,
                'industry_id' => $faker->randomElement($industry_id),
                'company_size' => $faker->randomElement(['01 - 05', '05 - 15', '15 - 30', '30 - 50', '50+']),
                'description' => $faker->paragraph,
                'active' => $faker->boolean,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];
        }

        DB::table('companies')->insert($companies);
    }
}
