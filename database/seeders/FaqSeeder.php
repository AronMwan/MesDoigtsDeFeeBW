<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = FaqCategory::all();

        foreach ($categories as $category) {
            Faq::factory()->count(5)->create([
                'faq_category_id' => $category->id,
            ]);
        }    
    }
}
