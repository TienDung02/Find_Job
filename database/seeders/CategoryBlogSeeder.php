<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $category_blogs = [];

        for ($i = 0; $i < 20; $i++) {
            $category_blogs[] = [
                'name' => $faker->word,
                'description' => $faker->sentence,
                'parent_id' => $faker->optional()->numberBetween(1, 10),
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('category_blogs')->insert($category_blogs);
    }
}
