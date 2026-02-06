<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use App\Models\Actie;
use DB;

class ActiesTableFactorySeeder extends Seeder
{

    protected static function getImageMap(): array
    {
        // list the image files in /storage/app/public/acties starting with seed_
        $storagePath = storage_path('app/public/acties');
        $imageFiles = [];
        if (file_exists($storagePath)) {
            $files = glob($storagePath . '/seed_*.png');
            foreach ($files as $file) {
                $imageFiles[] = 'acties/' . basename($file);
            }
        }
        return $imageFiles;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('acties')->delete();

        // Create Acties and attach an image from the image map
        $imageMap = $this->getImageMap();
        Actie::factory()
            ->count(20)
            ->create()
            ->each(function ($actie) use ($imageMap) {
                Image::create([
                    'path' => !empty($imageMap) ? $imageMap[array_rand($imageMap)] : null,
                    'actie_id' => $actie->id,
                ]);
            });
    }
}