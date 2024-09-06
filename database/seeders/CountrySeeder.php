<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $countries = $faker->locales;

        DB::table('locations')->truncate();

        $locations = [];
        foreach ($countries as $country) {
            $locations[] = [
                'country' => $country,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }

        DB::table('countries')->insert($locations);
    }
}
