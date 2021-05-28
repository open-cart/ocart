<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ocart\Blog\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Post::factory(30)->create();
    }
}
