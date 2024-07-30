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
        $category_blog = DB::table('categoryBlog')->pluck('category_blog_id');
        $blog = [];

        for ($i = 0; $i < 40; $i++) {
            $blog[] = [
                'title' => $faker->catchPhrase,
                'author' => $faker->name,
                'category_blog_id' => $faker->randomElement($category_blog),
                'img' => $faker->imageUrl,
                'desc' => $faker->paragraph,

            ];
        }
        DB::table('blogs')->insert($blog);
    }
}
