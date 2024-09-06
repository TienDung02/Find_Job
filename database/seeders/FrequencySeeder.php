<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_types = [
            ['name' => 'Daily'],
            ['name' => 'Weekly'],
            ['name' => 'Fortnightly'],
        ];
        DB::table('frequencies')->insert($job_types);
    }
}
