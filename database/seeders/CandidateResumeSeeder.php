<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CandidateResumeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $candidate_resume = [];
        $tags = DB::table('tags')->pluck('id');
        $province_id = DB::table('provinces')->pluck('id');
        $candidate_id = DB::table('candidates')->pluck('id');
        $numberOfRecords =count($candidate_id);
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $candidate = DB::table('candidates')->where('id', $candidate_id[$i])->first();
            $createdAt = $candidate->created_at;
            $full_name = $faker->firstName . ' ' . $faker->lastName;
            $email = DB::table('users')->where('id', $candidate->user_id)->value('email');

            $province = $faker->randomElement($province_id);

            $district = $faker->randomElement(DB::table('districts')->where('province_id', $province)->pluck('id'));

            $wards = $faker->randomElement(DB::table('wards')->where('district_id', $district)->pluck('id'));

            $type_salary = $faker->randomElement(['1', '2', '3']);
            if ($type_salary == 1){
                $minimum_salary = $faker->numberBetween(3000, 5000);
                $maximum_salary = $faker->numberBetween(5000, 10000);
                $salary = null;
            }elseif ($type_salary == 2){
                $minimum_salary = null;
                $maximum_salary = null;
                $salary = $faker->numberBetween(3000, 10000);
            }else{
                $minimum_salary = null;
                $maximum_salary = null;
                $salary = null;
            }

            $munber_tag = $faker->numberBetween(1, 5);
            $selected_tag_ids = $faker->randomElements($tags, $munber_tag);
            $tag_ids_string = implode(', ', $selected_tag_ids);

            $candidate_resume[] = [
                'candidate_id' => $candidate_id[$i],
                'full_name' => $full_name,
                'email' => $email,
                'photo' => 'https://avatar.iran.liara.run/username?username='. $full_name,
                'professional_title' => $faker->sentence(3),
                'province_id' => $province,
                'district_id' => $district,
                'ward_id' => $wards,
                'tag_id' => $tag_ids_string,
                'resume_content' => $faker->word,
                'type_salary' => $type_salary,
                'salary' => $salary,
                'minimum_salary' => $minimum_salary,
                'maximum_salary' => $maximum_salary,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null
            ];
        }
        DB::table('candidate_resumes')->insert($candidate_resume);
    }
}
