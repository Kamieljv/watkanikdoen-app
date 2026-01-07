<?php

namespace Database\Factories;

use App\Models\Actie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actie>
 */
class SubscriberFactory extends Factory
{

    // Setting model
    protected $model = Subscriber::class;

    public function definition(): array
    {        
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
        ];
    }

}
