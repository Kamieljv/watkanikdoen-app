<?php

namespace App\Console\Commands;

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use MWGuerra\FileManager\Models\FileSystemItem;

class ImportBooksFromIsbnCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:import-isbns {csv : Path to a CSV file containing ISBNs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import books from a CSV file of ISBNs, looking up each one and creating a Book entry.';

    public function handle(): int
    {
        $path = $this->argument('csv');

        if (!is_file($path) || !is_readable($path)) {
            $this->error("CSV file not found or not readable: {$path}");
            return 1;
        }

        try {
            $isbns = $this->readIsbnsFromCsv($path);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }

        if (empty($isbns)) {
            $this->error('No ISBNs found in the CSV file.');
            return 1;
        }

        $controller = new BookController();
        $created = 0;
        $skipped = 0;
        $failed = [];

        $this->withProgressBar($isbns, function (string $isbn) use ($controller, &$created, &$skipped, &$failed) {
            if (Book::where('isbn', $isbn)->exists()) {
                $skipped++;
                return;
            }

            try {
                $data = $controller->fetchBookDataByIsbn($isbn);

                if (empty($data['title'])) {
                    throw new \Exception('No book data found for this ISBN');
                }

                $coverImageUrl = $data['cover_image'] ?? null;
                unset($data['cover_image']);

                $book = Book::create($data);

                if ($coverImageUrl) {
                    $this->attachCoverImage($controller, $book, $coverImageUrl);
                }

                $created++;
            } catch (\Throwable $e) {
                $failed[] = ['isbn' => $isbn, 'reason' => $e->getMessage()];
            }
        });
        $this->newLine(2);

        $this->info("Created: {$created}, skipped (already exists): {$skipped}, failed: " . count($failed));

        foreach ($failed as $failure) {
            $message = "Could not create book for ISBN {$failure['isbn']}: {$failure['reason']}";
            $this->warn($message);
            Log::warning($message);
        }

        return empty($failed) ? 0 : 1;
    }

    /**
     * Download a book's remote cover image and attach it to the record.
     *
     * @param BookController $controller
     * @param Book $book
     * @param string $url
     */
    protected function attachCoverImage(BookController $controller, Book $book, string $url): void
    {
        $storagePath = $controller->downloadCoverImage($url, $book->isbn);

        if (!$storagePath) {
            return;
        }

        $folderId = FileSystemItem::where('name', 'books')
            ->where('type', 'folder')
            ->first()->id ?? null;

        $fileSystemItem = FileSystemItem::create([
            'parent_id' => $folderId,
            'name' => basename($storagePath),
            'type' => 'file',
            'file_type' => 'image',
            'size' => filesize(storage_path('app/public/' . $storagePath)),
            'storage_path' => $storagePath,
        ]);

        $book->image()->attach($fileSystemItem->id);
    }

    /**
     * Read the values in the CSV's "isbn" column.
     *
     * @return string[]
     * @throws \Exception if the file has no "isbn" column
     */
    protected function readIsbnsFromCsv(string $path): array
    {
        $handle = fopen($path, 'r');
        if ($handle === false) {
            return [];
        }

        $header = fgetcsv($handle);
        if ($header === false) {
            fclose($handle);
            return [];
        }

        $column = array_search('isbn', array_map(fn ($value) => strtolower(trim((string) $value)), $header), true);
        if ($column === false) {
            fclose($handle);
            throw new \Exception("CSV file has no \"isbn\" column: {$path}");
        }

        $isbns = [];
        while (($row = fgetcsv($handle)) !== false) {
            $isbn = trim((string) ($row[$column] ?? ''));
            if ($isbn !== '') {
                $isbns[] = $isbn;
            }
        }
        fclose($handle);

        return $isbns;
    }
}
