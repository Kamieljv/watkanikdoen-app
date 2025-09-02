<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReferentieType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use MWGuerra\FileManager\Models\FileSystemItem;

class Referentie extends Model
{
    use HasFactory;

    protected $table = 'referenties';

    protected $appends = [
        'image_url',
    ];

    protected $fillable = [
        'title',
        'url',
        'description',
        'status',
    ];

    protected $with = [
        'themes:id,name,color',
    ];

    public function referentie_types()
    {
        return $this->belongsToMany(ReferentieType::class, 'referentie_referentie_type');
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function image()
    {
        return $this->morphToMany(FileSystemItem::class, 'model', 'file_has_models', 'model_id', 'file_id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getImageUrlAttribute()
    {
        $image = $this->image()->where('file_type', 'image')->first();
        if ($image) {
            return asset('storage/' . $image->storage_path);
        }
        return null;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

}
