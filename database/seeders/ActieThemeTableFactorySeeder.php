<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;
use App\Models\Actie;
use DB;

class ActieThemeTableFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        # Cleaning relationship table
        DB::table('actie_theme')->delete();

        # Quantity of Themes
        $themeCount = Theme::count();

        # Populating the relationship table actie_theme using relationship
        # belongsToMany in actie->themes()
        Actie::select(['id'])->get()
            ->each(function ($actie) use ($themeCount) { 
                    $actie->themes()
                        ->attach(
                            Theme::all()
                                ->random(rand(1, $themeCount))
                                ->pluck('id')
                                ->toArray()
                        );
                }
            );
    }
}
