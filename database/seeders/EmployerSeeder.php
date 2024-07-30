<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $id_user = DB::table('users')->pluck('id');


        $employer = [];

        for ($i = 0; $i < 50; $i++) {
            $employer[] = [
                'id_user' => $faker->randomElement($id_user),
                'avatar' => $faker->imageUrl('https://avatar.iran.liara.run/public'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'tel' => $faker->phoneNumber,
                'about' => $faker->sentence,
                'active' => $faker->boolean,

            ];
        }

        DB::table('employers')->insert($employer);
    }
}
