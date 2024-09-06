<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ContentChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $id_chats = DB::table('chat_lists')->pluck('id');
        $content = [];

        for ($i = 0; $i < 500; $i++) {
            $chat_id  = $faker->randomElement($id_chats);
            $id_senders = DB::table('chat_lists')
                ->where('id', $chat_id)
                ->select(DB::raw('CASE WHEN FLOOR(RAND() * 2) = 0 THEN user_1 ELSE user_2 END AS random_user'))
                ->pluck('random_user');


            $sender_id  = $faker->randomElement($id_senders);

            $createdAt = DB::table('chat_lists')->where('id', $chat_id)->value('created_at');

            $createdAt = $faker->dateTimeBetween($createdAt, 'now');

            $status_sender = $faker->randomElement(['Fail', 'Deleted', 'Unsend', 'Sent', 'Received', 'Seen', 'Not Read Yet']);

            if ($status_sender == 'Fail' || $status_sender == 'Delete' || $status_sender == 'Sent' || $status_sender == 'Not Read Yet'){
                $status_receiver = '';
            }elseif ($status_sender == 'Received'){
                $status_receiver = $faker->randomElement(['', 'Seen', 'Not Read Yet']);
            }elseif ($status_sender == 'Seen'){
                $status_receiver = 'Seen';
            }elseif ($status_sender == 'Unsend'){
                $status_receiver = 'Unsend';
            }

            $content[] = [
                    'chat_id' => $chat_id,
                    'sender_id' => $sender_id,
                    'content' => $faker->text(100),
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
                    'status_sender' => $status_sender,
                    'status_receiver' => $status_receiver,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
        }

        DB::table('content_chats')->insert($content);
    }
}
