<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        FaqCategory::create(['name' => 'General']);
        FaqCategory::create(['name' => 'Billing']);
        FaqCategory::create(['name' => 'Account']);
        FaqCategory::create(['name' => 'Security']);
        FaqCategory::create(['name' => 'Technical']);
    }
}
