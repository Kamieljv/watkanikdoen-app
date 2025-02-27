<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Report;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    protected static $status_map = [
        'PENDING',
        'APPROVED',
        'REJECTED',
    ];

    public function definition(): array
    {
        # This number is the same in the count parameter in the seeder file
        $tot_elements = $this->count;

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
            'id' => $this->faker ->unique()->randomNumber(2,false),
            'user_id' => $this->faker->randomElement([1]),
            'organizer_ids' =>'1',
            'title' => 'Test report '.$this->faker->randomDigit(),
            'body' => '<p>'.$this->faker->paragraph().'</p>',
            'externe_link' =>'#',
            'start_date' => $start_date,
            'start_time' => $start_time,
            'end_date' => $end_date,
            'end_time' => $end_time,
            'location' => null,
            'location_human' => 'Loc',
            'image' => null,
            'status' => $this->faker->randomElement(static::$status_map),
            'created_at' => $create_at,
            'updated_at' => $update_at,

        ];
    }
}
