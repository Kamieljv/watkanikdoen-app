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

        #Organizer name setting
        $organizer_name = $this->faker
                            ->randomElement(static::$names_map);

        #Calculating create date from start date
        $create_at_obj =  $this->faker->dateTimeBetween( "-2years",now()) ;
        $create_at = $create_at_obj->format("Y-m-d H:i:s");

        #Calculating  updated date from create date
        $update_at_obj =  $this->faker->dateTimeBetween($create_at_obj,now()) ;
        $update_at = $update_at_obj->format("Y-m-d H:i:s");

        return [
            'id' => $this->faker ->unique()
                                -> randomElement([1,2,3,4]),
            'name' => $organizer_name,
            'description' => sprintf('<p>.This is a description for %s.</p>',$organizer_name),
            'website' => sprintf('https://%s.com',$organizer_name),
            'logo' => sprintf('organizers/%s_logo.jpg',$organizer_name),
            #slug should be unique
            'slug' =>  $organizer_name
                            .'-'.str_replace(' ','',$this->faker->unique()->streetName()),
            'status' => $this->faker->randomElement(static::$status_map),
            'created_at' => $create_at,
            'updated_at' => $update_at,
        ];
    }
}
