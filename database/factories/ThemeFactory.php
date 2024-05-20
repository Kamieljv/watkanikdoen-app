<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Theme;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    protected $model = Theme::class;

    protected static $names_map = [
        'Wonen',
        'Klimaat',
        'Dierenrechten',
        'Anti-racisme',
    ];
 
    public function definition( ): array
    {
        # This number is the same in the count parameter in the seeder file
        $tot_elements = $this->count;

        # Picking up one name
        $theme_seed = $this->faker
                            ->randomElement(static::$names_map);

        #Picking up random string 
        $diff =  '_'.$this->faker->unique()->word();

        #Generating name
        $theme_name = sprintf('%s%s', $theme_seed, $diff);

        #Calculating create date from start date
        $create_at_obj =  $this->faker->dateTimeBetween( "-2years",now()) ;
        $create_at = $create_at_obj->format("Y-m-d H:i:s");

        #Calculating  updated date from create date
        $update_at_obj =  $this->faker->dateTimeBetween($create_at_obj,now()) ;
        $update_at = $update_at_obj->format("Y-m-d H:i:s");

        return [
            'id' => $this->faker ->unique()-> randomNumber(2,false),
            'name' => $theme_name,
            'slug' => $theme_name,
            'color' => $this->faker->hexColor(),
            'created_at' => $create_at,
            'updated_at' => $update_at,
        ];
    }
}
