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

        $user_id = DB::table('users')->where('role', 2)->pluck('id');
        $numberOfRecords =count($user_id);
        $employer = [];

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $employer[] = [
                'user_id' => $user_id[$i],
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
