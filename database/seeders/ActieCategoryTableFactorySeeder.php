<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Actie;
use DB;

class ActieCategoryTableFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #Cleaning relationship table
        DB::table('actie_category')->delete();

        #Quantity of Organizers
        $categorieCount = Category::count();

        # Populating the relationship table actie_category using relationship
        # belongsToMany in actie->categories()
        Actie::all()
                ->each(function ($actie) use ($categorieCount) { 
                        $actie->categories()
                                ->attach(
                                    Category::all()
                                            ->random(rand(1, $categorieCount))
                                            ->pluck('id')
                                            ->toArray()
                                );
                        }
                    );
    }
}