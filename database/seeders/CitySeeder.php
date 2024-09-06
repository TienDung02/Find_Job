<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $location = [];

        for ($i = 0; $i < 30; $i++) {
            $location[] = [
                'city' => $faker->city(),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }

        DB::table('cities')->insert($location);
    }
}
