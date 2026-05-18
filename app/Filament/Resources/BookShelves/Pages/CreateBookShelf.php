<?php

namespace App\Filament\Resources\BookShelves\Pages;

use App\Filament\Resources\BookShelves\BookShelfResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBookShelf extends CreateRecord
{
    protected static string $resource = BookShelfResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Extract the books data before creating the record
        $booksData = $data['bookshelfBooks'] ?? [];
        unset($data['bookshelfBooks']);

        // Create the BookShelf record
        $record = static::getModel()::create($data);

        // Sync the books with pivot data
        $syncData = [];
        foreach ($booksData as $bookData) {
            if (isset($bookData['book_id'])) {
                $syncData[$bookData['book_id']] = [
                    'description' => $bookData['description'] ?? null,
                ];
            }
        }
        $record->books()->sync($syncData);

        return $record;
    }
}
