<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => Str::ucfirst(fake()->text(30)),
            'isbn' => "" . random_int(1000000000000, 9999999999999),
            'author' => fake()->name,
            'status' => random_int(0, 1),
            'created_at' => fake()->dateTime()
        ];
    }
}
