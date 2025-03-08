<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        
        return [
            'user_id' => 1,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->text(100),
            'content' => $this->faker->paragraphs(3, true),
            'publish_date' => now(),
            'status' => rand(0, 1), 
        ];
    }
}
