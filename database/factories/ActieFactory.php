<?php

namespace Database\Factories;

use App\Models\Actie;
use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actie>
 */
class ActieFactory extends Factory
{

    // Setting model
    protected $model = Actie::class;

    protected static $externe_link_map = [
        'https://utrecht.nl',
        'https://partijvoordedieren.nl',
        'https://nijmegen.nl',
    ];

    protected static $location_human_map = [
        'De Dam, Amsterdam',
        'Jaarbeursplein, Utrecht',
        'Museumplein, Amsterdam',
        'Valkhofpark, Nijmegen',
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
        'woonprotest-amsterdam',
    ];

    protected static $status_map = [
        'PUBLISHED',
        'DRAFT',
    ];

    protected static $keywords_map = [
        'demonstratie',
        'actie'
    ];

    public function definition(): array
    {

        // Picking a random action name
        $actie_name = $this->faker->sentence(4);

        // Fake an address for the location_human field
        $location_human = $this->faker->randomElement(static::$location_human_map);

        // Calculating the first date
        $start_date = $this->faker->dateTimeBetween('-2 years', '+2 years');
        // Calculating the end date from the start date
        $end_date = $this->faker->dateTimeInInterval($start_date, '+3 days');

        // Calculating create date from start date
        $created_at = $this->faker->dateTimeInInterval($start_date, "-2 days");
        // Calculating  updated date from create date
        $updated_at = $this->faker->dateTimeInInterval($created_at, '+1 hour');

        // Calculating random location and generating point string
        $latitude = $this->faker->latitude($min = 51, $max = 53);
        $longitude = $this->faker->longitude($min = 4, $max = 6);

        // Slugify the actie_name (URL safe) and add a hash to make unique
        $slug = strtolower(str_replace(' ', '-', $actie_name)) .  '-' . $this->faker->numerify('########');

        return [
            'user_id' => 1,
            'title' => $actie_name,
            'excerpt' => $this->faker->text(124),
            'body' => '<p>' . $this->faker->text(124) . ' <strong>' . $this->faker->text(146) . '</strong> ' . $this->faker->text(236) . '<em>Integer ' . $this->faker->text(34) . ' </em></p>',
            'externe_link' => $this->faker->randomElement(static::$externe_link_map),
            'start_date' => $start_date->format('Y-m-d'),
            'start_time' => $start_date->format('H:i:s'),
            'end_date' => $end_date->format('Y-m-d'),
            'end_time' => $end_date->format('H:i:s'),
            'location' => new Point($latitude, $longitude),
            'location_human' => $location_human,
            'image' => null,
            'slug' => $slug,
            'keywords' => $this->faker->randomElement(static::$keywords_map), // slug fied is unique. This is a provisory solution
            'disobedient' => 0,
            'pageviews' => $this->faker->numberBetween(30, 1000),
            'status' => $this->faker->randomElement(static::$status_map),
            'created_at' => $created_at->format("Y-m-d H:i:s"),
            'updated_at' => $updated_at->format("Y-m-d H:i:s"),
        ];
    }

}
