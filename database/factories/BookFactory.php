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
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author_id' => \App\Models\Author::factory(),
            'genre_id' => \App\Models\Genre::factory(),
            'publication_year' => $this->faker->year(),
            'description' => $this->faker->paragraph(),
            'cover_image' => $this->faker->imageUrl(640, 480, 'books'),
        ];
    }
}
