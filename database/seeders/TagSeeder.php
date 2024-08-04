<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 40; $i++) {
            $category_blogs[] = [
                'name' => $faker->word,
                'popular' => $faker->numberBetween(0, 20),
            ];
        }
        DB::table('tags')->insert($category_blogs);
    }
}
