<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            $category_blogs[] = [
                'name' => $faker->word,
                'parent_id' => $faker->optional()->numberBetween(1, 10),
            ];
        }

        DB::table('categories')->insert($category_blogs);
    }
}
