<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class JobAlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $candidates = DB::table('candidates')->get();
        $province_ids = DB::table('provinces')->pluck('id');
        $job_tags = DB::table('tags')->pluck('id');
        $job_types = DB::table('job_types')->pluck('id');
        $industry_ids = DB::table('industries')->pluck('id');
        $frequencies = DB::table('frequencies')->pluck('id');
        $count_candidate = count($candidates);
        $alert = [];

        for ($i = 0; $i < $count_candidate; $i++) {

            $munber_tag = $faker->numberBetween(1, 5);
            $selected_tag_ids = $faker->randomElements($job_tags, $munber_tag);
            $tag_ids_string = implode(', ', $selected_tag_ids);

            $createdAt = $faker->dateTimeBetween($candidates[$i]->created_at, 'now');

            $alert[] = [
                'candidate_id' => $candidates[$i]->id,
                'alert_name' => $faker->word,
                'keyword' => $faker->word,
                'province_id' => $faker->randomElement($province_ids),
                'frequency_id' => $faker->randomElement($frequencies),
                'tag_id' => $tag_ids_string,
                'job_type_id' => $faker->randomElement($job_types),
                'industry_id' => $faker->randomElement($industry_ids),
                'min_salary' => $faker->numberBetween(3000, 5000),
                'max_salary' => $faker->numberBetween(5000, 10000),
                'active' => $faker->randomElement([0, 1]),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];
        }

        DB::table('job_alerts')->insert($alert);
    }

}
