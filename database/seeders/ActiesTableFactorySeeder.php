<?php

namespace Database\Seeders;

use App\Models\Actie;
use DB;
use Illuminate\Database\Seeder;
use MWGuerra\FileManager\Models\FileSystemItem;

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

    protected static function attachImage(Actie $actie, string $storagePath): void
    {
        // Find or create the folder in the file system
        $folderId = FileSystemItem::where('name', 'acties')
                 ->where('type', 'folder')
                 ->first()->id ?? null;
             
        $fileSystemItem = FileSystemItem::create([
            'parent_id' => $folderId,
            'name' => $actie->id . '_' . basename($storagePath),
            'type' => 'file',
            'file_type' => 'image',
            'size' => filesize(storage_path('app/public/' . $storagePath)),
            'storage_path' => $storagePath,
        ]);

        // Attach the image to the actie
        $actie->image()->attach($fileSystemItem->id);
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
                $this->attachImage($actie, $imageMap[array_rand($imageMap)]);
            });
    }
}