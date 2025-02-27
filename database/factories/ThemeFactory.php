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
        'Klimaat',
        'Anti-racisme',
        'Dierenrechten',
        'Vrouwenrechten',
        'Migratie',
        'LGBTQIA+ rechten',
        'Leefomgeving',
        'Bezetting en kolonialisme',
        'Zorg en welzijn',
        'Democratie',
        'Anti-fascisme',
        'Mensenrechten',
        'Inclusiviteit',
        'Onderwijs',
        'Economie en ongelijkheid',
        'Anti-validisme',
    ];
 
    public function definition( ): array
    {
        # Picking up one name
        $theme_name = $this->faker->unique()->randomElement(static::$names_map);
    
        #Calculating create date from start date
        $created_at = $this->faker->dateTimeBetween("-2years" , 'now');

        #Calculating updated date from create date
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');

        # Slugify the name (URL safe)
        $slug = strtolower(str_replace(' ', '-', $theme_name));

        return [
            'name' => $theme_name,
            'slug' => $slug,
            'color' => $this->faker->hexColor(),
            'created_at' => $created_at->format("Y-m-d H:i:s"),
            'updated_at' => $updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
