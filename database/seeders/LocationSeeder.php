<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class LocationSeeder extends Seeder
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
                'name' => $faker->city(),
            ];
        }

        DB::table('location')->insert($location);
    }
}
