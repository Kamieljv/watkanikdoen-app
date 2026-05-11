<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BookShelf extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'organizer_id',
        'slug',
    ];

    /**
     * The organizer that owns this book shelf
     */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class);
    }

    /**
     * The books on this shelf (with description for each book)
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_shelf_book')
            ->withPivot('description')
            ->withTimestamps();
    }

    /**
     * The themes associated with this book shelf
     */
    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Theme::class, 'book_shelf_theme');
    }
}
