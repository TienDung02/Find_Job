<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $tags = [
            'PHP', 'C#', 'Java', 'Python', 'JavaScript', 'Ruby', 'Go', 'Swift', 'Kotlin', 'TypeScript', 'Rust', 'Scala', 'Perl', 'Lua', 'Objective-C', 'R',
            'HTML', 'CSS', 'JavaScript', 'TypeScript', 'React', 'Angular', 'Vue.js', 'Node.js', 'Express.js', 'Laravel', 'Django', 'Ruby on Rails', 'ASP.NET', 'Flask', 'Spring Boot', 'Ember.js', 'Svelte', 'Backbone.js', 'Bootstrap', 'Tailwind CSS',
            'MySQL', 'PostgreSQL', 'MongoDB', 'SQLite', 'Redis', 'Oracle', 'SQL Server', 'Cassandra', 'Elasticsearch', 'Firebase',
            'Docker', 'Kubernetes', 'AWS', 'Azure', 'Google Cloud Platform (GCP)', 'Jenkins', 'Travis CI', 'Git', 'GitHub', 'GitLab', 'Bitbucket', 'Terraform', 'Ansible', 'Chef', 'Puppet', 'Vagrant', 'Nginx', 'Apache', 'Webpack', 'Babel', 'Grunt', 'Gulp',
            'Finance', 'Healthcare', 'E-commerce', 'Education', 'Gaming', 'Telecom', 'Travel', 'Real Estate', 'Automotive', 'Manufacturing', 'Logistics', 'Entertainment', 'Media', 'Government', 'Energy', 'Non-profit',
            'Machine Learning', 'Artificial Intelligence (AI)', 'Data Science', 'Big Data', 'Blockchain', 'Internet of Things (IoT)', 'Augmented Reality (AR)', 'Virtual Reality (VR)', '5G', 'Cybersecurity', 'DevOps', 'Cloud Computing', 'Edge Computing'
        ];
        $numberOfRecords =count($tags);
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $category_blogs[] = [
                'name' => $tags[$i],
                'popular' => $faker->numberBetween(0, 20),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ];
        }
        DB::table('tags')->insert($category_blogs);
    }
}
