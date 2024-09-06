<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industries = [
            ['id' => 1, 'name' => 'Information Technology'],
            ['id' => 2, 'name' => 'Finance'],
            ['id' => 3, 'name' => 'Healthcare'],
            ['id' => 4, 'name' => 'Education'],
            ['id' => 5, 'name' => 'Construction'],
            ['id' => 6, 'name' => 'Hospitality'],
            ['id' => 7, 'name' => 'Retail'],
            ['id' => 8, 'name' => 'Manufacturing'],
            ['id' => 9, 'name' => 'Transportation'],
            ['id' => 10, 'name' => 'Energy'],
            ['id' => 11, 'name' => 'Insurance'],
            ['id' => 12, 'name' => 'Customer Service'],
            ['id' => 13, 'name' => 'Agriculture'],
            ['id' => 14, 'name' => 'Engineering'],
            ['id' => 15, 'name' => 'Media and Entertainment'],
            ['id' => 16, 'name' => 'Research and Development'],
            ['id' => 17, 'name' => 'Financial Services'],
            ['id' => 18, 'name' => 'Fashion'],
            ['id' => 19, 'name' => 'Legal Services'],
            ['id' => 20, 'name' => 'Public Health'],
            ['id' => 21, 'name' => 'Project Management'],
            ['id' => 22, 'name' => 'Maritime'],
            ['id' => 23, 'name' => 'Entertainment'],
            ['id' => 24, 'name' => 'Digital Services'],
            ['id' => 25, 'name' => 'Books and Publishing'],
            ['id' => 26, 'name' => 'Real Estate'],
            ['id' => 27, 'name' => 'Automotive Industry'],
            ['id' => 28, 'name' => 'Consumer Products'],
            ['id' => 29, 'name' => 'Consulting'],
            ['id' => 30, 'name' => 'Food and Beverage'],
            ['id' => 31, 'name' => 'Food Processing'],
            ['id' => 32, 'name' => 'Logistics'],
            ['id' => 33, 'name' => 'Chemicals'],
            ['id' => 34, 'name' => 'Electronics'],
            ['id' => 35, 'name' => 'International Business'],
            ['id' => 36, 'name' => 'Software Engineering'],
            ['id' => 37, 'name' => 'Personal Financial Services'],
            ['id' => 38, 'name' => 'Real Estate Development'],
            ['id' => 39, 'name' => 'Content Creation'],
            ['id' => 40, 'name' => 'Legal Consulting'],
            ['id' => 41, 'name' => 'Office Supplies and Printing'],
            ['id' => 42, 'name' => 'Legal Services'],
            ['id' => 43, 'name' => 'Automotive Industry'],
            ['id' => 44, 'name' => 'Heavy Industry'],
            ['id' => 45, 'name' => 'Maintenance and Repair'],
            ['id' => 46, 'name' => 'Textile Industry'],
            ['id' => 47, 'name' => 'Supply Chain Management'],
            ['id' => 48, 'name' => 'Biotechnology'],
            ['id' => 49, 'name' => 'Mental Health Services'],
            ['id' => 50, 'name' => 'Cultural Industries'],
        ];

        DB::table('industries')->insert($industries);
    }
}
