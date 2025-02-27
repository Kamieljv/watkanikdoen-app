<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organizer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organizer>          
 */
class OrganizerFactory extends Factory
{
    protected $model = Organizer::class;
    protected static $names_map = [
        'Greenpeace',
        'Kick Out Zwarte Piet',
        'Nederland Wordt Beter',
        'Woonprotest',
    ];

    protected static $status_map = [
        'PUBLISHED'        
    ];
    
    
    public function definition(): array
    {   
        # Organizer name
        $organizer_name = $this->faker->unique()->randomElement(static::$names_map);

        #Calculating create date from start date
        $created_at = $this->faker->dateTimeBetween("-2years" , 'now');

        #Calculating updated date from create date
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');

        # Slugify the name (URL safe)
        $slug = strtolower(str_replace(' ', '-', $organizer_name));

        return [
            'name' => $organizer_name,
            'description' => sprintf('<p>.This is a description for %s.</p>',$organizer_name),
            'website' => sprintf('https://%s.com',$organizer_name),
            'logo' => sprintf('organizers/%s_logo.jpg',$organizer_name),
            'slug' => $slug,
            'status' => $this->faker->randomElement(static::$status_map),
            'created_at' => $created_at->format("Y-m-d H:i:s"),
            'updated_at' => $updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
