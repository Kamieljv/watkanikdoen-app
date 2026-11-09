<?php

namespace Database\Seeders;

use App\Models\BookShelf;
use Illuminate\Database\Seeder;
use DB;

class BookShelvesTableFactorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('book_shelves')->delete();

        // Get an array of theme ids
        $themes = DB::table('themes')->pluck('id')->toArray();

        $books = DB::table('books')->pluck('id')->toArray();

        // Create 20 book shelves
        foreach (range(1, 20) as $i) {
            $organizerId = DB::table('organizers')->inRandomOrder()->first()->id;
            $bookShelf = BookShelf::factory()->create(['organizer_id' => $organizerId]);

            // Attach 1-3 random themes to the book shelf
            $randomThemes = (array) array_rand(array_flip($themes), rand(1, 3));
            $bookShelf->themes()->attach($randomThemes);

            // Attach 1-5 random books to the book shelf
            $randomBooks = (array) array_rand(array_flip($books), rand(1, 5));
            // Generate a random description for each book in the pivot table
            $bookDescriptions = array_map(fn() => ['description' => \Faker\Factory::create()->sentence()], $randomBooks);
            $bookShelf->books()->sync(array_combine($randomBooks, $bookDescriptions));
        }

        $this->command->info('Created 20 book shelves with themes and books.');
    }
}