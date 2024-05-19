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

        # This number is the same in the count parameter in the seeder file
        $tot_elements = $this->count;

        $name = $this->faker->unique()->randomElement(static::$names_map);

        #Calculating create date from start date
        $create_at_obj =  $this->faker->dateTimeBetween( "-2years",now()) ;
        $create_at = $create_at_obj->format("Y-m-d H:i:s");

        #Calculating  updated date from create date
        $update_at_obj =  $this->faker->dateTimeBetween($create_at_obj,now()) ;
        $update_at = $update_at_obj->format("Y-m-d H:i:s");
        
        return [
            'created_at' => $create_at,
            'id' => $this->faker ->unique()-> numberBetween(1,$tot_elements),
            'name' => $name,
            'slug' => strtolower($name),
            'updated_at' => $update_at,
    
        ];
    }
}
