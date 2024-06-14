<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminUser = User::where('email', 'admin@ehb.be')->first();

        Post::factory()->count(20)->create([
            'user_id' => $adminUser->id,
        ]);    }
}
