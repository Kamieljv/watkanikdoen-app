<?php

namespace Database\Factories;

use App\Models\BookShelf;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookShelfFactory extends Factory
{
    protected $model = BookShelf::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(2, 5)),
            'description' => $this->faker->paragraphs(rand(2, 4), true),
            'slug' => $this->faker->slug(),
        ];
    }
}
