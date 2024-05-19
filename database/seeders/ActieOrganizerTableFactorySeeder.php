<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizer;
use App\Models\Actie;
use DB;


class ActieOrganizerTableFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #Cleaning relationship table
        DB::table('actie_organizer')->delete();

        #Quantity of Organizers
        $organizersCount = Organizer::count();

        # Populating the relationship table actie_organizer using relationship
        # belongsToMany in actie->organizers()
        Actie::all()
                ->each(function ($actie) use ($organizersCount) { 
                        $actie->organizers()
                             ->attach(
                                 Organizer::all()
                                            ->random(rand(1, $organizersCount))
                                            ->pluck('id')
                                            ->toArray()
                                );
                        }
                    );
    }
}
