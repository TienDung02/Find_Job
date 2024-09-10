<?php

namespace Database\Seeders;

use App\Models\ChatList;
use App\Models\ContentChat;
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

        for ($i = 0; $i < 3000; $i++) {
            $chat_id  = $faker->randomElement($id_chats);
            $id_senders = DB::table('chat_lists')
                ->where('id', $chat_id)
                ->select(DB::raw('CASE WHEN FLOOR(RAND() * 2) = 0 THEN user_1 ELSE user_2 END AS random_user'))
                ->pluck('random_user');

            $sender_id  = $faker->randomElement($id_senders);

            $createdAt = DB::table('chat_lists')->where('id', $chat_id)->value('created_at');

            $createdAt = $faker->dateTimeBetween($createdAt, 'now');

            $status_sender = 'Sent';

            $content_chat = $faker->text(100);

            $status_receiver = $faker->randomElement(['Seen', 'Unread']);

            $chat = ChatList::query()->find($chat_id);
            if ($chat->last_messages_sender == $sender_id){
                if ($status_receiver == 'Unread'){
                    $chat->messages_unread ++;
                }else{
                    $chat_bf = ContentChat::query()->where('chat_id', $chat_id)->where('status_receiver', 'Unread')->get();
                    foreach ($chat_bf as $content_chat_bf){
                        $content_chat_bf->status_receiver = 'Seen';
                        $content_chat_bf->save();
                    }
                }
            }
            $chat->last_messages = $content_chat;
            $chat->last_messages_sender = $sender_id;

            if ($chat->user_1 == $sender_id){
                $chat->status_user_1 = $status_sender;
                $chat->status_user_2 = $status_receiver;
                if ($chat->status_user_2 == 'Seen'){
                    $chat->messages_unread = 0;
                }else{
                    $chat->messages_unread++;
                }
            }else{
                $chat->status_user_2 = $status_sender;
                $chat->status_user_1 = $status_receiver;
                if ($chat->status_user_1 == 'Seen'){
                    $chat->messages_unread = 0;
                }else{
                    $chat->messages_unread++;
                }
            }
            if ($chat->save()){
                $content[] = [
                    'chat_id' => $chat_id,
                    'sender_id' => $sender_id,
                    'content' => $content_chat,
                    'img_1' => 'https://img.freepik.com/free-vector/realistic-neon-lights-background_23-2148907367.jpg',
                    'status_sender' => $status_sender,
                    'status_receiver' => $status_receiver,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'deleted_at' => null
                ];
                if(count($content) == 100){
                    // insert
                    DB::table('content_chats')->insert($content);
                    $content = [];
                }
            }
        }

        if(!empty($content)){
            DB::table('content_chats')->insert($content);
        }
        // get chat list

        // foreach => get & update last messsage

    }


}
