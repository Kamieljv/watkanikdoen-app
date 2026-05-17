<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(2, 5)),
            'description' => $this->faker->paragraphs(rand(2, 4), true),
            'author' => $this->faker->name(),
            'year' => $this->faker->year(),
            'isbn' => $this->faker->isbn13(),
            'cover_image' => sprintf('https://picsum.photos/id/%d/%d/%d', rand(1, 1000), 200, 300), // Placeholder image URL with random query to ensure uniqueness
        ];
    }
}
