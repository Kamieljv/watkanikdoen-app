<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Actie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actie>
 */
class ActieFactory extends Factory
{
    
    #Setting model
    protected $model = Actie::class;
    
    # Setting dummy types
    protected static $titles_map = [
        'Klimaatdemo',
        'Black Lives Matter',
        'Kick Out Zwarte Piet',
        'Woonprotest',
        'Bio-industrie Protest'
    ];

    protected static $externe_link_map = [
        'https://utrecht.nl',
        'https://partijvoordedieren.nl',
        'https://nijmegen.nl',
        '#'
    ] ;
    
    protected static $location_human_map = [

        'De Dam, Amsterdam',
        'Jaarbeursplein, Utrecht',
        'Museumplein, Amsterdam',
        'Valkhofpark, Nijmegen'
    ];

    protected static $slug_map = [
        'bio-industrie-protest',
        'black-lives-matter-amsterdam',
        'black-lives-matter-nijmegen',
        'black-lives-matter-utrecht',
        'kick-out-zwarte-piet',
        'klimaatdemo-amsterdam',
        'klimaatdemo-nijmegen',
        'klimaatdemo-utrecht',
        'woonprotest-amsterdam'

    ] ;
    
    protected static $status_map = [
        'PUBLISHED',
        'DRAFT',
        'PENDING'        
    ] ;


    protected static $image_map = [
        null,
       'acties/pexels-karolina-grabowska-8106775-resize-500.jpg',
       'acties/pexels-markus-spiske-3039036-resize-500.jpg',
       'acties/pexels-paddy-o-sullivan-2369217-resize-500.jpg'
   ];

   protected static $keywords_map = [
        null
   ] ;

   protected static $location_map = [
    'POINT (5.1065183336479 52.088538312124)',
    null    
   ];

    public function definition(): array
    {   
        #Calculating the first date
        $start_date_obj = $this->faker->dateTimeBetween('-2year ',now()) ;
        $start_date = $start_date_obj->format('Y-m-d');
        $start_time = $start_date_obj->format('H:i:s');

        # Calculating the end date from the start date
        $end_date_obj =  $this->faker->dateTimeBetween( $start_date_obj,now()) ;
        $end_date =  $end_date_obj ->format('Y-m-d');
        $end_time =  $end_date_obj->format('H:i:s');

        #Calculating create date from start date
        $create_at_obj =  $this->faker->dateTimeBetween( "-2years",$start_date_obj) ;
        $create_at = $create_at_obj->format("Y-m-d H:i:s");

        #Calculating  updated date from create date
        $update_at_obj =  $this->faker->dateTimeBetween($create_at_obj,now()) ;
        $update_at = $update_at_obj->format("Y-m-d H:i:s");

        return [
            
            'id' => $this->faker->unique()->randomElement([11,12,16,17,19,20,23,24,25]), #Fixed id to preserve the relationship with others tables - To change after
            'user_id' => $this->faker->randomElement([1]),
            'title' => $this->faker->randomElement(static::$titles_map),
            'excerpt' => $this->faker->text(124),
            'body' => '<p>'. $this->faker->text(124).' <strong>'.$this->faker->text(146).'</strong> '.$this->faker->text(236).'<em>Integer '.$this->faker->text(34).' </em></p>',
            'externe_link' => $this->faker->randomElement(static::$externe_link_map),
            'start_date' => $start_date,
            'start_time' => $start_time,
            'end_date' => $end_date,
            'end_time' => $end_time,
            'location' => ($this->faker->randomElement(static::$location_map) === null) ? null 
                                                                                : DB::raw("ST_GeomFromText('POINT (5.1065183336479 52.088538312124)')"),
            'location_human' => $this->faker->randomElement(static::$location_human_map),
            'image' =>  $this->faker->randomElement( static::$image_map),
            'slug' => $this->faker->randomElement(static::$slug_map).
                            $this->faker->unique()->randomDigit(),
            'keywords' => $this->faker->randomElement(static::$keywords_map), # slug fied is unique. This is a provisory solution 
            'disobedient' => (int)$this->faker->boolean(),
            'pageviews' => $this->faker->numberBetween(30, 1000),
            'status' => $this->faker->randomElement( static::$status_map),
            'created_at' => $create_at,
            'updated_at' => $update_at,
        ];
    } 


}
