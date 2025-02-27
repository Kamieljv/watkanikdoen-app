<?php
namespace Database\Seeders;

use App\Models\Actie;
use App\Models\Category;
use DB;
use Illuminate\Database\Seeder;

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
                            ->random(1)
                            ->pluck('id')
                            ->toArray()
                    );
            }
            );
    }
}
