<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Organizer;
use DB;
use Illuminate\Database\Seeder;

class OrganizersTableFactorySeeder extends Seeder
{
    protected static function getImageMap(): array
    {
        // list the image files in /storage/app/public/organizers starting with seed_
        $storagePath = storage_path('app/public/organizers');
        $imageFiles = [];
        if (file_exists($storagePath)) {
            $files = glob($storagePath . '/seed_*.png');
            foreach ($files as $file) {
                $imageFiles[] = 'organizers/' . basename($file);
            }
        }
        return $imageFiles;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizers')->delete();

        // Create Organizers and attach an image from the image map
        $imageMap = $this->getImageMap();

        Organizer::factory()
            ->count(4)
            ->create()
            ->each(function ($organizer) use ($imageMap) {
                Image::create([
                    'path' => !empty($imageMap) ? $imageMap[array_rand($imageMap)] : null,
                    'organizer_id' => $organizer->id,
                ]);
            });
    }
}
