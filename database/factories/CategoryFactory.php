<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Ficção', 'Romance', 'Terror', 'Fantasia', 'Suspense', 
                'Biografia', 'Autoajuda', 'Ciência', 'História', 'Tecnologia'
            ]),
            'description' => $this->faker->sentence(10),
        ];
    }
}