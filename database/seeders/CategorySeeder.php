<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run()
    {
        $fixedCategories = [
            ['name' => 'Accounting / Finance', 'parent_id' => 0, 'level' => 1, 'type' => 0, 'is_popular' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Automotive Jobs', 'parent_id' => 0, 'level' => 1, 'type' => 0, 'is_popular' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Construction / Facilities', 'parent_id' => 0, 'level' => 1, 'type' => 0, 'is_popular' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Education / Training', 'parent_id' => 0, 'level' => 1, 'type' => 0, 'is_popular' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Healthcare', 'parent_id' => 0, 'level' => 1, 'type' => 0, 'is_popular' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Restaurant / Food Service', 'parent_id' => 0, 'level' => 1, 'type' => 0, 'is_popular' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Transportation / Logistics', 'parent_id' => 0, 'level' => 1, 'type' => 0, 'is_popular' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Telecommunication', 'parent_id' => 0, 'level' => 1, 'type' => 0, 'is_popular' => 1, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
        ];

        DB::table('categories')->insert($fixedCategories);

        $faker = Faker::create();
//        $categories_1 = [];
//
//        for ($i = 0; $i < 2; $i++) {
//            $categories_1[] = [
//                'name' => $faker->word,
//                'parent_id' => 0,
//                'level' => 1,
//                'type' => $i < 3 ? 1 : 2,
//                'is_popular' => 0,
//                'created_at' => now(),
//                'updated_at' => now(),
//                'deleted_at' => null
//            ];
//        }
//        DB::table('categories')->insert($categories_1);

        $categories_2 = [];
        $parentId_1 = DB::table('categories')->pluck('id');
        for ($i = 0; $i < 30; $i++) {
            $categories_2[] = [
                'name' => $faker->word,
                'parent_id' => $faker->randomElement($parentId_1),
                'level' => 2,
                'type' => $i < 12 ? 1 : 2,
                'is_popular' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }
        DB::table('categories')->insert($categories_2);

        $categories_3 = [];
        $parentId_2 = DB::table('categories')->where('level',2)->pluck('id');
        for ($i = 0; $i < 18; $i++) {
            $categories_3[] = [
                'name' => $faker->word,
                'parent_id' => $faker->randomElement($parentId_2),
                'level' => 3,
                'type' => $i < 9 ? 1 : 2,
                'is_popular' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }
        DB::table('categories')->insert($categories_3);

    }
}
