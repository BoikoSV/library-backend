<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userId = User::all('id')->random(1)[0]->id;
        $bookId = Book::all('id')->random(1)[0]->id;
        return [
            'due_date' => fake()->dateTime,
            'return_date' => fake()->dateTime,
            'user_id' => $userId,
            'book_id' => $bookId
        ];
    }
}
