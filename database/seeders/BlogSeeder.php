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
        $category_blog = DB::table('categories')->where('type' ,2)->pluck('id');
        $blog = [];

        for ($i = 0; $i < 40; $i++) {
            $blog[] = [
                'title' => $faker->catchPhrase,
                'author' => $faker->name,
                'category_blog_id' => $faker->randomElement($category_blog),
                'img' => $faker->randomElement([
                    '/storage/uploads/blog/blog-post-01.jpg',
                    '/storage/uploads/blog/blog-post-02.jpg',
                    '/storage/uploads/blog/blog-post-03.jpg',
                ]),
                'desc' => $faker->paragraph,
                'content' => $faker->text(500),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }
        DB::table('blogs')->insert($blog);
    }
}
