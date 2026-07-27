<?php

namespace Database\Seeders;

use App\Models\Book;
use DB;
use Illuminate\Database\Seeder;
use MWGuerra\FileManager\Models\FileSystemItem;

class BooksTableFactorySeeder extends Seeder
{
    protected static function getImageMap(): array
    {
        // list the image files in /storage/app/public/books starting with seed_
        $storagePath = storage_path('app/public/books');
        $imageFiles = [];
        if (file_exists($storagePath)) {
            $files = glob($storagePath . '/seed_*.png');
            foreach ($files as $file) {
                $imageFiles[] = 'books/' . basename($file);
            }
        }
        return $imageFiles;
    }

    protected static function attachImage(Book $book, string $storagePath): void
    {
        // Find or create the folder in the file system
        $folderId = FileSystemItem::where('name', 'books')
                 ->where('type', 'folder')
                 ->first()->id ?? null;

        $fileSystemItem = FileSystemItem::create([
            'parent_id' => $folderId,
            'name' => $book->id . '_' . basename($storagePath),
            'type' => 'file',
            'file_type' => 'image',
            'size' => filesize(storage_path('app/public/' . $storagePath)),
            'storage_path' => $storagePath,
        ]);

        // Attach the image to the book
        $book->image()->attach($fileSystemItem->id);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->delete();

        // Get an array of theme ids
        $themes = DB::table('themes')->pluck('id')->toArray();

        if (empty($themes)) {
            $this->command->warn('No themes found. Please seed themes first.');
            return;
        }

        // Create 20 books and attach an image from the image map
        $imageMap = $this->getImageMap();

        foreach (range(1, 20) as $i) {
            $book = Book::factory()->create();

            // Attach 1-3 random themes to the book
            $randomThemes = (array) array_rand(array_flip($themes), rand(1, min(3, count($themes))));
            $book->themes()->attach($randomThemes);

            if (!empty($imageMap)) {
                $this->attachImage($book, $imageMap[array_rand($imageMap)]);
            }
        }

        $this->command->info('Created 20 books with cover images and themes.');
    }
}
