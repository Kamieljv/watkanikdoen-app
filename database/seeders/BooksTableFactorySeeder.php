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
        $folderId = FileSystemItem::firstOrCreate(
            ['name' => 'books', 'type' => 'folder'],
            ['parent_id' => null, 'storage_path' => 'books']
        )->id;
             
        $fileSystemItem = FileSystemItem::create([
            'parent_id' => $folderId,
            'name' => $book->id . '_' . basename($storagePath),
            'type' => 'file',
            'file_type' => 'image',
            'size' => filesize(storage_path('app/public/' . $storagePath)),
            'storage_path' => $storagePath,
        ]);

        // Update the book with the cover image path
        $book->update(['cover_image' => $storagePath]);
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

        $imageMap = $this->getImageMap();
        
        if (empty($imageMap)) {
            $this->command->warn('No book cover images found. Please run SampleImagesSeeder first.');
            return;
        }

        // Create 20 books
        foreach (range(1, 20) as $i) {
            $book = Book::factory()->create();
            
            // Attach 1-3 random themes to the book
            $randomThemes = (array) array_rand(array_flip($themes), rand(1, min(3, count($themes))));
            $book->themes()->attach($randomThemes);
            
            // Attach a cover image
            $this->attachImage($book, $imageMap[array_rand($imageMap)]);
        }

        $this->command->info('Created 20 books with cover images and themes.');
    }
}
