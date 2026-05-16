<?php

namespace Database\Seeders;

use App\Models\Book;
use DB;
use Illuminate\Database\Seeder;

class BooksTableFactorySeeder extends Seeder
{
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

        // Create 20 books
        foreach (range(1, 20) as $i) {
            $book = Book::factory()->create();

            // Attach 1-3 random themes to the book
            $randomThemes = (array) array_rand(array_flip($themes), rand(1, min(3, count($themes))));
            $book->themes()->attach($randomThemes);
        }

        $this->command->info('Created 20 books with cover images and themes.');
    }
}
