<?php

namespace App\Traits;

use MWGuerra\FileManager\Models\FileSystemItem;

trait HandlesImageUpload
{
    /**
     * Get the folder name for storing images
     * This must be implemented by the class using this trait
     */
    abstract protected function getImageFolderName(): string;

    /**
     * Get the folder ID for the image storage
     */
    protected function getImageFolderId(): ?int
    {
        return FileSystemItem::where('name', $this->getImageFolderName())
            ->where('type', 'folder')
            ->first()->id ?? null;
    }

    /**
     * Create or get a FileSystemItem for the uploaded image
     */
    protected function createImageFileSystemItem(string $storagePath): FileSystemItem
    {
        $folderId = $this->getImageFolderId();

        return FileSystemItem::firstOrCreate([
            'storage_path' => $storagePath,
        ], [
            'parent_id' => $folderId,
            'name' => basename($storagePath),
            'type' => 'file',
            'file_type' => 'image',
            'size' => filesize(storage_path('app/public/' . $storagePath)),
            'storage_path' => $storagePath,
        ]);
    }

    /**
     * Attach an image to the record
     */
    protected function attachImage(string $storagePath): void
    {
        $fileSystemItem = $this->createImageFileSystemItem($storagePath);
        $this->record->image()->attach($fileSystemItem->id);
    }

    /**
     * Update the image, detaching old one and attaching new one
     */
    protected function updateImage(string $storagePath): void
    {
        // Remove old images
        $this->record->image()->detach();

        // Attach new image
        $this->attachImage($storagePath);
    }

    /**
     * Check if the image has changed
     */
    protected function hasImageChanged(string $newStoragePath): bool
    {
        return $this->record->image()->first()?->storage_path !== $newStoragePath;
    }
}
