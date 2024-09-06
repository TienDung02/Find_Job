<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BlogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $id_user = DB::table('users')
            ->whereIn('role', [2, 3])
            ->pluck('id');

        $id_blog = DB::table('blogs')->pluck('id');
        $blog = [];

        for ($i = 0; $i < 300; $i++) {
            $blog_id = $faker->randomElement($id_blog);
            $user_id = $faker->randomElement($id_user);
            $createdAt_blog = DB::table('blogs')->where('id', $blog_id)->value('created_at');
            $createdAt_user = DB::table('users')->where('id', $user_id)->value('created_at');

                if ($createdAt_blog > $createdAt_user) {
                    $createdAt = $createdAt_blog;
                    $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                } else {
                    $createdAt = $createdAt_user;
                    $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                }
                $blog[] = [
                    'blog_id' => $blog_id,
                    'user_id' => $user_id,
                    'content' => $faker->text(100),
                    'reply_to' => '0',
                    'img_1' => 'https://img.freepik.com/free-vector/realistic-neon-lights-background_23-2148907367.jpg',
                    'img_2' => '',
                    'img_3' => '',
                    'img_4' => '',
                    'img_5' => '',
                    'img_6' => '',
                    'img_7' => '',
                    'img_8' => '',
                    'img_9' => '',
                    'img_10' => '',
                    'img_11' => '',
                    'img_12' => '',
                    'img_13' => '',
                    'img_14' => '',
                    'img_15' => '',
                    'img_16' => '',
                    'img_17' => '',
                    'img_18' => '',
                    'img_19' => '',
                    'img_20' => '',
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
        }
        DB::table('blog_comments')->insert($blog);


        for ($i = 0; $i < 200; $i++) {
            $blog_id_2 = $faker->randomElement($id_blog);
            $reply_to = DB::table('blog_comments')
                ->where('blog_id', $blog_id_2)
                ->where('id', '>', 0)
                ->where('id', '<', 300)
                ->pluck('id');
            if (count($reply_to) > 0){
                $user_id_2 = $faker->randomElement($id_user);
                $createdAt = DB::table('blog_comments')->where('id', $reply_to)->value('created_at');
                $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                $blog_2[] = [
                    'blog_id' => $blog_id_2,
                    'user_id' => $user_id_2,
                    'content' =>  $faker->text(100),
                    'reply_to' => $faker->randomElement($reply_to),
                    'img_1' =>  'https://img.freepik.com/free-vector/realistic-neon-lights-background_23-2148907367.jpg',
                    'img_2' =>  '',
                    'img_3' =>  '',
                    'img_4' =>  '',
                    'img_5' =>  '',
                    'img_6' =>  '',
                    'img_7' =>  '',
                    'img_8' =>  '',
                    'img_9' =>  '',
                    'img_10' =>  '',
                    'img_11' =>  '',
                    'img_12' =>  '',
                    'img_13' =>  '',
                    'img_14' =>  '',
                    'img_15' =>  '',
                    'img_16' =>  '',
                    'img_17' =>  '',
                    'img_18' =>  '',
                    'img_19' =>  '',
                    'img_20' =>  '',
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
            }
        }
        DB::table('blog_comments')->insert($blog_2);

        for ($i = 0; $i < 200; $i++) {
            $blog_id_3 = $faker->randomElement($id_blog);
            $reply_to_2 = DB::table('blog_comments')
                ->where('blog_id', $blog_id_3)
                ->where('id', '>', 300)
                ->where('id', '<', 500)
                ->pluck('id');
            if (count($reply_to_2) > 0){
                $createdAt = DB::table('blog_comments')->where('id', $reply_to_2)->value('created_at');
                $createdAt = $faker->dateTimeBetween($createdAt, 'now');
                $blog_3[] = [
                    'blog_id' => $blog_id_3,
                    'user_id' => $user_id,
                    'content' =>  $faker->text(100),
                    'reply_to' => $faker->randomElement($reply_to),
                    'img_1' =>  'https://img.freepik.com/free-vector/realistic-neon-lights-background_23-2148907367.jpg',
                    'img_2' =>  '',
                    'img_3' =>  '',
                    'img_4' =>  '',
                    'img_5' =>  '',
                    'img_6' =>  '',
                    'img_7' =>  '',
                    'img_8' =>  '',
                    'img_9' =>  '',
                    'img_10' =>  '',
                    'img_11' =>  '',
                    'img_12' =>  '',
                    'img_13' =>  '',
                    'img_14' =>  '',
                    'img_15' =>  '',
                    'img_16' =>  '',
                    'img_17' =>  '',
                    'img_18' =>  '',
                    'img_19' =>  '',
                    'img_20' =>  '',
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
            }
        }
        DB::table('blog_comments')->insert($blog_3);
    }
}
