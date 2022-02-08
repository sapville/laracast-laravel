<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = User::factory()->create();

        $workCategory = Category::factory()->create([
            'slug' => 'work',
            'name' => 'Work'
        ]);
        $personalCategory = Category::factory()->create([
            'slug' => 'personal',
            'name' => 'Personal'
        ]);
        $familyCategory = Category::factory()->create([
            'slug' => 'family',
            'name' => 'Family'
        ]);


        Post::factory(10)->create([
            'user_id' => $user->id,
            'category_id' => $workCategory->id,
        ]);
        Post::factory(8)->create([
            'category_id' => $personalCategory->id,
        ]);
        Post::factory(6)->create([
            'user_id' => $user->id,
            'category_id' => $familyCategory->id,
        ]);
        Post::factory(10)->create();

    }
}
