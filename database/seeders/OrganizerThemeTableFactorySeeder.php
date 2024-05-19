<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;
use App\Models\Organizer;
use DB;

class OrganizerThemeTableFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #Cleaning relationship table
        DB::table('organizer_theme')->delete();

        #Quantity of Themes
        $themeCount = Theme::count();

        # Populating the relationship table organizer_theme using relationship
        # belongsToMany in actie->themes()
        Organizer::all()
                ->each(function ($organizer) use ($themeCount) { 
                        $organizer->themes()
                                ->attach(
                                    Theme::all()
                                            ->random(rand(0, $themeCount))
                                            ->pluck('id')
                                            ->toArray()
                                );
                        }
                    );
    }
}
