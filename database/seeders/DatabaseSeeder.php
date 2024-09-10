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
            FrequencySeeder::class,

            DistrictSeeder::class,
            ProvinceSeeder::class,
            WardSeeder::class,
//
            UserSeeder::class,
//
            TagSeeder::class,

            CategorySeeder::class,

            EmployerSeeder::class,
            IndustrySeeder::class,
            CompanySeeder::class,

            CandidateSeeder::class,
            CandidateResumeSeeder::class,
            CandidateEducationSeeder::class,
            CandidateExperienceSeeder::class,
            candidateNetworkProfileSeeder::class,

            JobTypeSeeder::class,
            JobSeeder::class,
            ApplyJobSeeder::class,
            BookmarkSeeder::class,

            BlogSeeder::class,
//            BlogCommentSeeder::class,

            ApplicationStatusSeeder::class,
            JobAlertSeeder::class,

            ChatListSeeder::class,
            ContentChatSeeder::class,
        ]);

    }
}
