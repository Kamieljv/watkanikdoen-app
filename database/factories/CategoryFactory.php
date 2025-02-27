<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    protected static $names_map =[
        'Demonstratie',
        'Petitie',
    ];

    public function definition(): array
    {

        $name = $this->faker->unique()->randomElement(static::$names_map);

        #Calculating create date from start date
        $created_at = $this->faker->dateTimeBetween("-2years" , 'now');

        #Calculating updated date from create date
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');

        # Slugify the name (URL safe)
        $slug = strtolower(str_replace(' ', '-', $name));

        
        return [
            'name' => $name,
            'slug' => $slug,
            'created_at' => $created_at->format("Y-m-d H:i:s"),
            'updated_at' => $updated_at->format("Y-m-d H:i:s"),
    
        ];
    }
}
