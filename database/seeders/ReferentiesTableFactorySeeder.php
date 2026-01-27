<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Referentie;
use App\Models\ReferentieType;
use DB;
use Illuminate\Database\Seeder;

class ReferentiesTableFactorySeeder extends Seeder
{
    protected static function getImageMap(): array
    {
        // list the image files in /storage/app/public/referenties starting with seed_
        $storagePath = storage_path('app/public/referenties');
        $imageFiles = [];
        if (file_exists($storagePath)) {
            $files = glob($storagePath . '/seed_*.png');
            foreach ($files as $file) {
                $imageFiles[] = 'referenties/' . basename($file);
            }
        }
        return $imageFiles;
    }

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
                // attach an image from the image map
                $imageMap = $this->getImageMap();
                Image::create([
                    'path' => !empty($imageMap) ? $imageMap[array_rand($imageMap)] : null,
                    'referentie_id' => $referentie->id,
                ]);
            }
        }
    }
}