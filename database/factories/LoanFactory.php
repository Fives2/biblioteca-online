<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    public function definition(): array
    {
        $loanDate = $this->faker->dateTimeBetween('-6 months', 'now');
        $dueDate = (clone $loanDate)->modify('+15 days');

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'book_id' => Book::where('available', true)->inRandomOrder()->first()->id ?? Book::factory(),
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'return_date' => $this->faker->optional(0.6)->dateTimeBetween($loanDate, $dueDate),
            'status' => $this->faker->randomElement(['active', 'returned', 'overdue']),
        ];
    }
}