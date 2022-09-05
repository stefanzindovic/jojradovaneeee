<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => fake()->word(),
            'description' => fake()->paragraph(5),
            'isbn' => fake()->numerify('#############'),
            'total_pages' => rand(10, 5000),
            'total_copies' => rand(1, 999),
            'published_at' => fake()->year(),
            'cover_id' => rand(1, 10),
            'publisher_id' => rand(1, 10),
            'format_id' => rand(1, 10),
            'language_id' => rand(1, 10),
            'script_id' => rand(1, 10),
        ];
    }
}
