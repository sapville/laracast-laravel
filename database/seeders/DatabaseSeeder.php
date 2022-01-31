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
        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('posts')->truncate();

        $user = User::factory()->create();

        $workCategory = Category::create([
            'slug' => 'work',
            'name' => 'Work'
        ]);
        $personalCategory = Category::create([
            'slug' => 'personal',
            'name' => 'Personal'
        ]);
        $familyCategory = Category::create([
            'slug' => 'family',
            'name' => 'Family'
        ]);

        Post::create([
           'slug' => 'work-post',
           'category_id' => $workCategory->id,
            'user_id' => $user->id,
            'title' => 'Work post',
            'excerpt' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'published_at' => null
        ]);
        Post::create([
            'slug' => 'personal-post',
            'category_id' => $personalCategory->id,
            'user_id' => $user->id,
            'title' => 'Personal post',
            'excerpt' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'published_at' => null
        ]);
    }
}
