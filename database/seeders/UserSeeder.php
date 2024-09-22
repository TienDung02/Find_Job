<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker::create();

        $users = [];

        for ($i = 0; $i < 100; $i++) {
            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            if ($i < 8){
                $role = $faker->randomElement([1, 4, 5, 6, 7, 8]);
            }else{
                $role = $faker->randomElement([2, 3]);
            }
            $user_name = $faker->userName;
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $users[] = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $faker->unique()->safeEmail,
                'avatar' => $faker->randomElement([
                    '/storage/uploads/avatar_user/150(1).jpg',
                    '/storage/uploads/avatar_user/150(2).jpg',
                    '/storage/uploads/avatar_user/150(3).jpg',
                    '/storage/uploads/avatar_user/150(4).jpg',
                    '/storage/uploads/avatar_user/150(5).jpg',
                    '/storage/uploads/avatar_user/150(6).jpg',
                    '/storage/uploads/avatar_user/150(7).jpg',
                    '/storage/uploads/avatar_user/150(8).jpg',
                    '/storage/uploads/avatar_user/150(9).jpg',
                    '/storage/uploads/avatar_user/150(10).jpg',
                    '/storage/uploads/avatar_user/150(11).jpg',
                    '/storage/uploads/avatar_user/150(12).jpg',
                    '/storage/uploads/avatar_user/150(13).jpg',
                    '/storage/uploads/avatar_user/150(14).jpg',
                    '/storage/uploads/avatar_user/150(15).jpg',
                    '/storage/uploads/avatar_user/150(16).jpg',
                    '/storage/uploads/avatar_user/150(17).jpg',
                    '/storage/uploads/avatar_user/150(18).jpg',
                    '/storage/uploads/avatar_user/150(19).jpg',
                    '/storage/uploads/avatar_user/150(20).jpg',
                    '/storage/uploads/avatar_user/150(21).jpg',
                    '/storage/uploads/avatar_user/150(22).jpg',
                    '/storage/uploads/avatar_user/150(23).jpg',
                    '/storage/uploads/avatar_user/150(24).jpg',
                    '/storage/uploads/avatar_user/150(25).jpg',
                    '/storage/uploads/avatar_user/150(26).jpg',
                    '/storage/uploads/avatar_user/150(27).jpg',
                    '/storage/uploads/avatar_user/150(28).jpg',
                    '/storage/uploads/avatar_user/150(29).jpg',
                    '/storage/uploads/avatar_user/150(30).jpg',
                    '/storage/uploads/avatar_user/150(31).jpg',
                    '/storage/uploads/avatar_user/150(32).jpg',
                    '/storage/uploads/avatar_user/150(33).jpg',
                    '/storage/uploads/avatar_user/150(34).jpg',
                    '/storage/uploads/avatar_user/150(35).jpg',
                    '/storage/uploads/avatar_user/150(36).jpg',
                    '/storage/uploads/avatar_user/150(37).jpg',
                    '/storage/uploads/avatar_user/150(38).jpg',
                    '/storage/uploads/avatar_user/150(39).jpg',
                    '/storage/uploads/avatar_user/150(40).jpg',
                    '/storage/uploads/avatar_user/150(41).jpg',
                    '/storage/uploads/avatar_user/150(42).jpg',
                    '/storage/uploads/avatar_user/150(43).jpg',
                    '/storage/uploads/avatar_user/150(44).jpg',
                    '/storage/uploads/avatar_user/150(45).jpg',
                    '/storage/uploads/avatar_user/150(46).jpg',
                    '/storage/uploads/avatar_user/150(47).jpg',
                    '/storage/uploads/avatar_user/150(48).jpg',
                    '/storage/uploads/avatar_user/150(49).jpg',
                    '/storage/uploads/avatar_user/150(50).jpg',
                    '/storage/uploads/avatar_user/150(51).jpg',
                    '/storage/uploads/avatar_user/150(52).jpg',
                    '/storage/uploads/avatar_user/150(53).jpg',
                    '/storage/uploads/avatar_user/150(54).jpg',
                    '/storage/uploads/avatar_user/150(55).jpg',
                    '/storage/uploads/avatar_user/150(56).jpg',
                    '/storage/uploads/avatar_user/150(57).jpg',
                    '/storage/uploads/avatar_user/150(58).jpg',
                    '/storage/uploads/avatar_user/150(59).jpg',
                    '/storage/uploads/avatar_user/150(60).jpg',
                ]),
                'password' => Hash::make('123'),
                'role' => $role,
                'active' => $faker->boolean,
                'last_message_selected' => 0,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];
        }

        DB::table('users')->insert($users);
    }
}
