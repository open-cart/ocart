<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ocart\Blog\Models\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text(255);
        return [
            'name' => $name,
            'description' => $this->faker->words(50, true),
            'content' => $this->faker->words(500, true),
            'status' => 'published',
            'author_id' => 1,
            'author_type' => User::class,
            'is_featured' => 2,
            'image' => $this->faker->name,
            'views' => 0,
            'format_type' => $this->faker->name,
            'slug' => Str::slug($name),
            'slug_md5' => md5($name),
        ];
    }
}
