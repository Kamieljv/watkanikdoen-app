<?php

namespace Database\Seeders;

use App\Models\Organizer;
use DB;
use Illuminate\Database\Seeder;
use MWGuerra\FileManager\Models\FileSystemItem;

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

    protected static function attachImage(Organizer $organizer, string $storagePath): void
    {
        // Find or create the folder in the file system
        $folderId = FileSystemItem::where('name', 'organizers')
                 ->where('type', 'folder')
                 ->first()->id ?? null;
             
        $fileSystemItem = FileSystemItem::create([
            'parent_id' => $folderId,
            'name' => $organizer->id . '_' . basename($storagePath),
            'type' => 'file',
            'file_type' => 'image',
            'size' => filesize(storage_path('app/public/' . $storagePath)),
            'storage_path' => $storagePath,
        ]);

        // Attach the image to the organizer
        $organizer->image()->attach($fileSystemItem->id);
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
                $this->attachImage($organizer, $imageMap[array_rand($imageMap)]);
            });
    }
}
