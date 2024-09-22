<?php

namespace Database\Seeders;

use App\Models\ChatList;
use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ChatListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user_ids = DB::table('users')->pluck('id');

        $chat_list = [];

        for ($i = 0; $i < 200; $i++) {
            $user_id_1 = $faker->randomElement($user_ids);
            $user_id_2 = $faker->randomElement($user_ids);
            $check_ids = ChatList::query()->where('user_1', $user_id_1)->pluck('user_2')->toArray();
            while ($user_id_1 == $user_id_2 || in_array($user_id_2, $check_ids)) {
                $user_id_2 = $faker->randomElement($user_ids);
            }

            $last_messages_sender = $faker->randomElement([$user_id_1, $user_id_2]);
            if ($last_messages_sender == $user_id_1){
                $status_user_1 = $faker->randomElement(['Fail', 'Sent']);
                if ($status_user_1 == 'Fail'){
                    $status_user_2 = null;
                }else{
                    $status_user_2 = $faker->randomElement(['Seen']);
                }
            }elseif ($last_messages_sender == $user_id_2){
                $status_user_2 = $faker->randomElement(['Fail', 'Sent']);
                if ($status_user_2 == 'Fail'){
                    $status_user_1 = null;
                }else{
                    $status_user_1 = $faker->randomElement(['Seen']);
                }
            }




            $createdAt_user_1 = DB::table('users')->where('id', $user_id_1)->value('created_at');
            $createdAt_user_2 = DB::table('users')->where('id', $user_id_2)->value('created_at');
            if ($createdAt_user_1 > $createdAt_user_2){
                $createdAt = $faker->dateTimeBetween($createdAt_user_1, 'now');
            }else{
                $createdAt = $faker->dateTimeBetween($createdAt_user_2, 'now');
            }
            $chat_list[] = [
                'user_1' => $user_id_1,
                'user_2' => $user_id_2,
                'last_messages' => '...',
                'last_messages_sender' => $last_messages_sender,
                'messages_unread' => 1,
                'status_user_1' => $status_user_1,
                'status_user_2' => $status_user_2,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];
        }

        DB::table('chat_lists')->insert($chat_list);
    }

}
