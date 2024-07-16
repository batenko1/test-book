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
            'title' => $this->faker->sentence,
            'publisher' => $this->faker->company,
            'author' => $this->faker->name,
            'genre' => $this->faker->word,
            'publication_date' => $this->faker->date,
            'count_words' => $this->faker->numberBetween(1000, 5000),
            'price' => $this->faker->numberBetween(100, 1000)
        ];
    }
}
