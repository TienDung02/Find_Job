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
            ['id' => 1, 'name' => 'Information Technology', 'icon' => '<i class="bi bi-code-slash"></i>'],
            ['id' => 2, 'name' => 'Finance', 'icon' => '<i class="bi bi-graph-up"></i>'],
            ['id' => 3, 'name' => 'Healthcare', 'icon' => '<i class="bi bi-activity"></i>'],
            ['id' => 4, 'name' => 'Education', 'icon' => '<i class="bi bi-mortarboard"></i>'],
            ['id' => 5, 'name' => 'Construction', 'icon' => '<i class="bi bi-cone-striped"></i>'],
            ['id' => 6, 'name' => 'Hospitality', 'icon' => '<i class="bi bi-file-medical-fill"></i>'],
            ['id' => 7, 'name' => 'Retail', 'icon' => '<i class="bi bi-shop-window"></i>'],
            ['id' => 8, 'name' => 'Manufacturing', 'icon' => '<i class="bi bi-gear"></i>'],
            ['id' => 9, 'name' => 'Transportation', 'icon' => '<i class="bi bi-truck"></i>'],
            ['id' => 10, 'name' => 'Energy', 'icon' => '<i class="bi bi-lightning-charge"></i>'],
            ['id' => 11, 'name' => 'Insurance', 'icon' => '<i class="bi bi-shield-check"></i>'],
            ['id' => 12, 'name' => 'Telecommunications', 'icon' => '<i class="bi bi-telephone"></i>'],
            ['id' => 13, 'name' => 'Real Estate', 'icon' => '<i class="bi bi-house-door"></i>'],
            ['id' => 14, 'name' => 'Engineering', 'icon' => '<i class="bi bi-wrench"></i>'],
            ['id' => 15, 'name' => 'Media and Entertainment', 'icon' => '<i class="bi bi-tv"></i>'],
            ['id' => 16, 'name' => 'Research and Development', 'icon' => '<i class="bi bi-search"></i>'],
            ['id' => 17, 'name' => 'Financial Services', 'icon' => '<i class="bi bi-wallet"></i>'],
            ['id' => 18, 'name' => 'Fashion', 'icon' => '<i class="bi bi-handbag"></i>'],
            ['id' => 20, 'name' => 'Entertainment', 'icon' => '<i class="bi bi-tv"></i>'],
            ['id' => 21, 'name' => 'Books and Publishing', 'icon' => '<i class="bi bi-book"></i>'],
            ['id' => 22, 'name' => 'Food and Beverage', 'icon' => '<i class="bi bi-cup-straw"></i>'],
            ['id' => 23, 'name' => 'Logistics', 'icon' => '<i class="bi bi-truck"></i>'],
            ['id' => 24, 'name' => 'Chemicals', 'icon' => '<i class="bi bi-radioactive"></i>'],
            ['id' => 25, 'name' => 'Electronics', 'icon' => '<i class="bi bi-cpu"></i>'],
            ['id' => 26, 'name' => 'International Business', 'icon' => '<i class="bi bi-globe2"></i>'],
            ['id' => 27, 'name' => 'Software Engineering', 'icon' => '<i class="bi bi-laptop"></i>'],
            ['id' => 28, 'name' => 'Office Supplies and Printing', 'icon' => '<i class="bi bi-printer"></i>'],
            ['id' => 29, 'name' => 'Heavy Industry', 'icon' => '<i class="bi bi-gear-fill"></i>'],
            ['id' => 30, 'name' => 'Maintenance and Repair', 'icon' => '<i class="bi bi-tools"></i>'],
            ['id' => 31, 'name' => 'Supply Chain Management', 'icon' => '<i class="bi bi-recycle"></i>'],
            ['id' => 32, 'name' => 'Consulting', 'icon' => '<i class="bi bi-headset"></i>'],
            ['id' => 36, 'name' => 'Home and Garden', 'icon' => '<i class="bi bi-house"></i>'],
            ['id' => 40, 'name' => 'Non-Profit', 'icon' => '<i class="bi bi-hand-thumbs-up"></i>'],
        ];

        DB::table('industries')->insert($industries);
    }
}
