<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'isbn' => $this->faker->unique()->isbn13(),
            'description' => $this->faker->paragraph(4),
            'pages' => $this->faker->numberBetween(80, 650),
            'published_at' => $this->faker->date('Y-m-d', '-10 years'),
            'author_id' => Author::inRandomOrder()->first()->id ?? Author::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'available' => $this->faker->boolean(80),
        ];
    }
}