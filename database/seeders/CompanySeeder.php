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
                'company_logo' => $faker->randomElement([
                    '/storage/uploads/company/logo/job-list-logo-01.png',
                    '/storage/uploads/company/logo/job-list-logo-02.png',
                    '/storage/uploads/company/logo/job-list-logo-03.png',
                    '/storage/uploads/company/logo/job-list-logo-04.png',
                    '/storage/uploads/company/logo/job-list-logo-05.png',
                    '/storage/uploads/company/logo/job-list-logo-06.png',
                    '/storage/uploads/company/logo/job-list-logo-07.png',
                    '/storage/uploads/company/logo/job-list-logo-08.png',
                    '/storage/uploads/company/logo/job-list-logo-09.png',
                    '/storage/uploads/company/logo/job-list-logo-10.png',
                    '/storage/uploads/company/logo/job-list-logo-11.png',
                    '/storage/uploads/company/logo/job-list-logo-12.png',
                    '/storage/uploads/company/logo/job-list-logo-13.png',
                    '/storage/uploads/company/logo/job-list-logo-14.png',
                    '/storage/uploads/company/logo/job-list-logo-15.png',
                    '/storage/uploads/company/logo/job-list-logo-16.png',
                    '/storage/uploads/company/logo/job-list-logo-17.png',
                    '/storage/uploads/company/logo/job-list-logo-18.png',
                    '/storage/uploads/company/logo/job-list-logo-19.png',
                    '/storage/uploads/company/logo/job-list-logo-20.png',
                    '/storage/uploads/company/logo/job-list-logo-21.png',
                    '/storage/uploads/company/logo/job-list-logo-22.png',
                    '/storage/uploads/company/logo/job-list-logo-23.png',
                    '/storage/uploads/company/logo/job-list-logo-24.png',
                ]),
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
