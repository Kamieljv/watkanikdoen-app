<?php

namespace App\Models;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use MWGuerra\FileManager\Models\FileSystemItem;

class Book extends Resource
{
    use HasFactory;

    protected $appends = [
        'tag_names',
        'cover_image',
    ];

    protected $hidden = [
        'tags',
    ];

    /**
     * Add fillable attributes to the base Resource model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->mergeFillable([
            'publisher',
            'isbn',
        ]);

        parent::__construct($attributes);
    }

    public function image()
    {
        return $this->morphToMany(FileSystemItem::class, 'model', 'file_has_models', 'model_id', 'file_id');
    }

    public function getCoverImageAttribute(): ?string
    {
        $image = $this->image()->where('file_type', 'image')->first();
        if ($image) {
            return asset('storage/' . $image->storage_path);
        }
        return null;
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getTagNamesAttribute()
    {
        return $this->tags->pluck('name');
    }

    public function bookShelves()
    {
        return $this->belongsToMany(BookShelf::class, 'book_shelf_book')
            ->withPivot('description')
            ->withTimestamps();
    }
}