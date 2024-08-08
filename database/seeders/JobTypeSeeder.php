<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_types = [
            ['name' => 'Full-Time'],
            ['name' => 'Part-Time'],
            ['name' => 'Internship'],
            ['name' => 'Freelance'],
            ['name' => 'Temporary'],
        ];
        DB::table('job_types')->insert($job_types);
    }
}
