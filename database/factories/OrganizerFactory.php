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
    protected $qt;
    protected static $names_map = [
        'Greenpeace',
        'Kick Out Zwarte Piet',
        'Nederland Wordt Beter',
        'Woonprotest',
        "nietmijnschuld", 
        "2-dh5", 
        "actiegroep-nijmegen", 
        "actionaid", 
        "active-for-justice", 
        "activistenpartij-uva", 
        "alliantie-politica", 
        "anarcha-fem-amsterdam", 
        "anarchistische-anti-deportatie-groep-utrecht", 
        "anti-imperialist-front", 
        "anti-kernenergie-beweging", 
        "aralez", 
        "aseed", 
        "aseed-europe", 
        "attila-suba-green-revolution-foundation", 
        "autonomous-student-struggle", 
        "baas-in-eigen-buik", 
        "baasineigenbuik", 
        "bds-nederland", 
        "bij1", 
        "bijstandsbond", 
        "bits-of-freedom",

    ];

    protected static $status_map = [
        'PENDING',
        'APPROVED',
        'REJECTED',
        'PUBLISHED'        
    ] ;
    
    
    public function definition(): array
    {   
        # This number is the same in the count parameter in the seeder file
        $tot_elements = $this->count;

        $organizer_seed = $this->faker
                            ->unique()->randomElement(static::$names_map);

        #Picking up random string 
        // $diff =  '_'.str_repeat("_",$this->faker->randomDigit());
           $diff = '';

        #Generating name
        $organizer_name = sprintf('%s%s', $organizer_seed, $diff);

        #Calculating create date from start date
        $create_at_obj =  $this->faker->dateTimeBetween( "-2years",now()) ;
        $create_at = $create_at_obj->format("Y-m-d H:i:s");

        #Calculating  updated date from create date
        $update_at_obj =  $this->faker->dateTimeBetween($create_at_obj,now()) ;
        $update_at = $update_at_obj->format("Y-m-d H:i:s");

        return [
            'id' => $this->faker ->unique()
                                -> randomNumber(2,false),
            'name' => $organizer_name,
            'description' => sprintf('<p>.This is a description for %s.</p>',$organizer_name),
            'website' => sprintf('https://%s.com',$organizer_name),
            'logo' => sprintf('organizers/%s_logo.jpg',$organizer_name),
            'slug' =>  $organizer_name,
            'status' => $this->faker->randomElement(static::$status_map),
            'created_at' => $create_at,
            'updated_at' => $update_at,
        ];
    }
}
