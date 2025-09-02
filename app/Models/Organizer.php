<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use MWGuerra\FileManager\Models\FileSystemItem;

class Organizer extends Model
{
    use HasFactory;
    
    protected $appends = [
        'link',
        'website_human',
        'image_url',
    ];

    protected $fillable = [
        'name',
        'description',
        'website',
        'slug',
        'user_id',
        'featured',
        'status',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'themes:id,name,color,slug',
    ];

    public function getLinkAttribute()
    {
        return url('/organisator/' . $this->slug);
    }

    public function getWebsiteHumanAttribute()
    {
        if ($this->website) {
            if (substr($this->website, 0, 4) != 'http') {
                $this->website = '//' . $this->website;
            }
            return str_replace('www.', '', parse_url($this->website)['host']);
        }
        return null;
    }

    public function approve()
    {
        $this->status = Status::APPROVED->name;
        $this->save();
    }

    public function getApproveUrl()
    {
        return route('organizer.approve', $this->id);
    }

    public function publish()
    {
        $this->status = Status::PUBLISHED;
        $this->save();
    }

    public function acties()
    {
        return $this->hasMany(Actie::class);
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function image()
    {
        return $this->morphToMany(FileSystemItem::class, 'model', 'file_has_models', 'model_id', 'file_id');
    }

    public function getImageUrlAttribute()
    {
        $image = $this->image()->first();
        if ($image) {
            return asset('storage/' . $image->storage_path);
        }
        return null;
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
    public function getPublishedAttribute()
    {
        return $this->status === Status::PUBLISHED;
    }

    public function isPublished(): bool
    {
        return $this->status === Status::PUBLISHED;
    }

    public function scopePublished($query)
    {
        return $query->where('status', Status::PUBLISHED);
    }
}
