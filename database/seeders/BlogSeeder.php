<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $category_blog = DB::table('categories_blog')->pluck('id_category_blog');
        $blog = [];

        for ($i = 0; $i < 40; $i++) {
            $blog[] = [
                'title' => $faker->catchPhrase,
                'author' => $faker->name,
                'id_category_blog' => $faker->randomElement($category_blog),
                'img' => $faker->imageUrl,
                'desc' => $faker->paragraph,
                'create_at' => now(),
                'update_at' => now(),
            ];
        }

        DB::table('blogs')->insert($blog);
    }
}
