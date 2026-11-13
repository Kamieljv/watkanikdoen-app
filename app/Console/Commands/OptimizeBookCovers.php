<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Services\BookCoverOptimizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class OptimizeBookCovers extends Command
{
    protected $signature = 'books:optimize-covers {--dry-run : Only list the covers that would be converted}';

    protected $description = 'Convert all book cover images to WebP, scaled down to ' . BookCoverOptimizer::MAX_WIDTH . 'px wide.';

    public function handle(BookCoverOptimizer $optimizer): int
    {
        $disk = Storage::disk('public');

        $images = Book::with('image')->get()
            ->flatMap(fn(Book $book) => $book->image)
            ->filter(fn($item) => $item->file_type === 'image' && $item->storage_path)
            ->unique('id')
            // Several records can point at the same file
            ->groupBy('storage_path');

        if ($this->option('dry-run')) {
            $this->table(['File', 'Size'], $images->keys()->map(fn($path) => [
                $path,
                $disk->exists($path) ? round($disk->size($path) / 1024) . ' KB' : 'missing',
            ]));
            return 0;
        }

        $before = 0;
        $after = 0;
        $failed = [];

        $this->withProgressBar($images, function ($items) use ($optimizer, $disk, &$before, &$after, &$failed) {
            $path = $items->first()->storage_path;

            if (!$disk->exists($path)) {
                $failed[] = "{$path}: file missing";
                return;
            }

            try {
                $before += $disk->size($path);
                $newPath = $optimizer->optimize($path);
                $size = $disk->size($newPath);
                $after += $size;

                foreach ($items as $item) {
                    $item->update([
                        'storage_path' => $newPath,
                        'name' => basename($newPath),
                        'size' => $size,
                    ]);
                }
            } catch (\Throwable $e) {
                $failed[] = "{$path}: {$e->getMessage()}";
            }
        });
        $this->newLine(2);

        $this->info(sprintf(
            'Converted %d covers: %s KB -> %s KB',
            $images->count() - count($failed),
            number_format($before / 1024),
            number_format($after / 1024),
        ));

        foreach ($failed as $failure) {
            $this->warn($failure);
        }

        return empty($failed) ? 0 : 1;
    }
}
