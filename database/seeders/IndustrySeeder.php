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
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('industries')->insert($industries);
    }
}
