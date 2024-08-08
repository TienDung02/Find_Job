<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $industries = [];

        for ($i = 0; $i < 20; $i++) {
            $industries[] = [
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }

        DB::table('industries')->insert($industries);
    }
}
