<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

     protected static $names_map = [
        'Foie gras',
        'Studieschuld',
        'Palestina',
        'Iran',
        'Kurdistan',
        'Oekraïne',
        'Fossiele brandstoffen',
        'Fossiele subsidies',
        'Abortus',
        'Femicide',
    ];

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(self::$names_map),
        ];
    }
}