<?php

namespace Database\Seeders;

use App\Models\industry;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\user::factory(10)->create();
        $this->call([
            UserSeeder::class,

            CategorySeeder::class,

            CandidateSeeder::class,
            CandidateEducationSeeder::class,
            CandidateExperienceSeeder::class,
            candidateNetworkProfileSeeder::class,

            LocationSeeder::class,

            EmployerSeeder::class,

            IndustrySeeder::class,
            CompanySeeder::class,

            TagSeeder::class,
            JobTypeSeeder::class,
            JobSeeder::class,
            ApplyJobSeeder::class,
            BookmarkSeeder::class,

            BlogSeeder::class,
        ]);

    }
}
