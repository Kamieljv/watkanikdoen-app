<?php

namespace Database\Factories;

use App\Models\Referentie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actie>
 */
class ReferentieFactory extends Factory
{

    // Setting model
    protected $model = Referentie::class;

    protected static $externe_link_map = [
        'https://utrecht.nl',
        'https://partijvoordedieren.nl',
        'https://nijmegen.nl',
    ];

    protected static $status_map = [
        'PUBLISHED',
        'DRAFT',
    ];

    protected static $image_map = [
        null,
        'https://picsum.photos/200',
    ];

    public function definition(): array
    {

        // Picking a random action name (without trailing dot)
        $referentie_name = substr($this->faker->sentence(4), 0, -1);

        // Calculating create date from start date
        $created_at = $this->faker->dateTimeBetween("-2 days", 'now');
        // Calculating  updated date from create date
        $updated_at = $this->faker->dateTimeInInterval($created_at, '+1 hour');

        // Slugify the actie_name (URL safe) and add a hash to make unique
        $slug = strtolower(str_replace(' ', '-', $referentie_name)) .  '-' . $this->faker->numerify('########');

        return [
            'title' => $referentie_name,
            'url' => $this->faker->randomElement(static::$externe_link_map),
            'description' => $this->faker->text(124),
            'image' => $this->faker->randomElement(static::$image_map),
            'status' => $this->faker->randomElement(static::$status_map),            
            'created_at' => $created_at->format("Y-m-d H:i:s"),
            'updated_at' => $updated_at->format("Y-m-d H:i:s"),
        ];
    }

}
