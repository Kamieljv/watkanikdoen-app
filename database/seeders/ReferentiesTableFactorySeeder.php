<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Referentie;
use App\Models\ReferentieType;
use DB;

class ReferentiesTableFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('referenties')->delete();
        // create 10 referenties for each referentie type with a random theme
        $referentieTypes = ReferentieType::all();
        // get an array of theme ids
        $themes = DB::table('themes')->pluck('id')->toArray();


        foreach ($referentieTypes as $referentieType) {
            foreach(range(1, 10) as $i) {
                $referentie = Referentie::factory()->create();
                // attach the referentie type to the referentie
                $referentie->referentie_types()->attach($referentieType->id);
                // attach a random theme to the referentie
                $referentie->themes()->attach($themes[array_rand($themes)]);
            }
        }
    }
}