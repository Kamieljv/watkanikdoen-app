<?php

namespace App\Filament\Resources\BookShelves\Pages;

use App\Filament\Resources\BookShelves\BookShelfResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditBookShelf extends EditRecord
{
    protected static string $resource = BookShelfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load the books with pivot data
        $data['bookshelfBooks'] = $this->record->books->map(function ($book) {
            return [
                'book_id' => $book->id,
                'description' => $book->pivot->description,
            ];
        })->toArray();

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Extract the books data before updating the record
        $booksData = $data['bookshelfBooks'] ?? [];
        unset($data['bookshelfBooks']);

        // Update the BookShelf record
        $record->update($data);

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
