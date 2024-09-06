<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_types = [
            ['name' => 'Reject'],
            ['name' => 'Interviewed'],
            ['name' => 'Offer extended'],
            ['name' => 'Hired'],
            ['name' => 'Archived'],
        ];
        DB::table('application_statuses')->insert($job_types);
    }
}
