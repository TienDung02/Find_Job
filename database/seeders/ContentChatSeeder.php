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

        for ($i = 0; $i < 5000; $i++) {
            $chat_id = $faker->randomElement($id_chats);

            $id_senders = DB::table('chat_lists')
                ->where('id', $chat_id)
                ->select(DB::raw('CASE WHEN FLOOR(RAND() * 2) = 0 THEN user_1 ELSE user_2 END AS random_user'))
                ->pluck('random_user');

            $sender_id = $faker->randomElement($id_senders);

            $createdAt = ContentChat::query()->where('chat_id', $chat_id)->orderBy('created_at', 'DESC')->first();
            if (is_null($createdAt)) {
                $createdAt = DB::table('chat_lists')->where('id', $chat_id)->value('created_at');
            }

            $createdAt = $faker->dateTimeBetween($createdAt, 'now');

            $status_sender = 'Sent';
            $content_chat = $faker->text(100);
            $status_receiver = $faker->randomElement(['Seen', 'Unread']);

            $chat = ChatList::query()->find($chat_id);
            if ($chat->last_messages_sender == $sender_id) {
                if ($status_receiver == 'Unread') {
                    $chat->messages_unread++;
                } else {
                    $chat_bf = ContentChat::query()->where('chat_id', $chat_id)->where('status_receiver', 'Unread')->get();
                    foreach ($chat_bf as $content_chat_bf) {
                        $content_chat_bf->status_receiver = 'Seen';
                        $content_chat_bf->save();
                    }
                }
            }
            $chat->last_messages = $content_chat;
            $chat->last_messages_sender = $sender_id;

            if ($chat->user_1 == $sender_id) {
                $chat->status_user_1 = $status_sender;
                $chat->status_user_2 = $status_receiver;
                if ($chat->status_user_2 == 'Seen') {
                    $chat->messages_unread = 0;
                } else {
                    $chat->messages_unread++;
                }
            } else {
                $chat->status_user_2 = $status_sender;
                $chat->status_user_1 = $status_receiver;
                if ($chat->status_user_1 == 'Seen') {
                    $chat->messages_unread = 0;
                } else {
                    $chat->messages_unread++;
                }
            }

            $images = [
                'img_1' => 'https://img.freepik.com/free-vector/realistic-neon-lights-background_23-2148907367.jpg',
                'img_2' => 'https://img.freepik.com/free-vector/blue-curve-background_53876-113112.jpg',
                'img_3' => 'https://png.pngtree.com/thumb_back/fh260/background/20230408/pngtree-rainbow-curves-abstract-colorful-background-image_2164067.jpg',
                'img_4' => 'https://static.vecteezy.com/system/resources/thumbnails/001/849/553/small_2x/modern-gold-background-free-vector.jpg',
                'img_5' => 'https://img.freepik.com/free-vector/copy-space-bokeh-spring-lights-background_52683-55649.jpg',
            ];

            $maxImages = 5;
            $imageKeys = array_keys($images);

            $rate = rand(1, 100);
            if ($rate <= 75) {
                $numImages = 0;
            } else {
                $numImages = rand(1, $maxImages);
            }

            $entry = [
                'chat_id' => $chat_id,
                'sender_id' => $sender_id,
                'content' => $content_chat,
                'status_sender' => $status_sender,
                'status_receiver' => $status_receiver,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];

            foreach ($imageKeys as $index => $key) {
                if ($index < $numImages) {
                    $entry[$key] = $images[$key];
                } else {
                    $entry[$key] = null;
                }
            }

            $content[] = $entry;

            if (count($content) == 100) {
                // Insert data into the database
                DB::table('content_chats')->insert($content);
                $content = [];
            }
        }

        if (!empty($content)) {
            DB::table('content_chats')->insert($content);
        }

        $chat_list = ChatList::query()->get();
        foreach ($chat_list as $chat) {
            $last_messages = ContentChat::query()->where('chat_id', $chat->id)->orderBy('created_at', 'DESC')->first();
            if (!is_null($last_messages)) {
                $unread_messages = ContentChat::where('chat_id', $chat->id)->where('status_receiver', 'Unread')->count();
                $chat->last_messages = $last_messages->content;
                $chat->last_messages_sender = $last_messages->sender_id;
                if ($last_messages->status_receiver == 'Unread') {
                    $chat->messages_unread = $unread_messages;
                } else {
                    $chat->messages_unread = 0;
                    $messages_update = ContentChat::query()->where('chat_id', $chat->id)->get();
                    foreach ($messages_update as $update) {
                        $update->status_receiver = 'Seen';
                        $update->save();
                    }
                }

                if ($chat->user_1 == $last_messages->sender_id) {
                    $chat->status_user_1 = $last_messages->status_sender;
                    $chat->status_user_2 = $last_messages->status_receiver;
                } else {
                    $chat->status_user_2 = $last_messages->status_sender;
                    $chat->status_user_1 = $last_messages->status_receiver;
                }
                $chat->save();
            } else {
                $chat->delete();
            }
        }
    }



}
