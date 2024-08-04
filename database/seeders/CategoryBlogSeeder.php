<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\CategoryBlog;
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

        for ($i = 0; $i < 5; $i++) {
            $category_blogs[] = [
                'name' => $faker->word,
                'parent_id' => 0,
                'description' => $faker->sentence,
                'level' => 1
            ];
        }
        DB::table('categories_blogs')->insert($category_blogs);

        for ($i = 0; $i < 15; $i++) {
            $parentCategories = CategoryBlog::query()->where('level', '<', 4)->get();
            $parentCategory = $faker->randomElement($parentCategories->toArray());
            $parentId = $parentCategory['id'];
            $query = CategoryBlog::query()->where('id', $parentId)->get();
            foreach ($query as $p){
                $parentId2 = $p['parent_id'];
                if ($parentId2 == 0){
                    $level = 2;
                }elseif ($parentId2 != 0){
                    $query2 = CategoryBlog::query()->where('id', $parentId2)->get();
                    foreach ($query2 as $p2)
                    {
                        $parentId3 = $p2['parent_id'];
                        if ($parentId3 != 0){
                            $level = 4;
                        }else{
                            $level = 3;
                        }
                    }
                }
            }

            $category_blogs[] = [
                'name' => $faker->word,
                'parent_id' => $parentId,
                'description' => $faker->sentence,
                'level' => $level
            ];
        }
        DB::table('categories_blogs')->insert($category_blogs);


    }
}
