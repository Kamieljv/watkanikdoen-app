<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Actie extends Model
{
    use HasSpatial;
    use HasFactory;

    protected $spatial = ['location'];

    /**
     * Select geometrical attributes as text from database.
     *
     * @var bool
     */
    protected $geometryAsText = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'externe_link',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'location',
        'location_human',
        'slug',
        'image',
        'status',
        'disobedient',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'link',
        'afgelopen',
        'start_end',
        'start_unix',
        '_geoloc',
    ];

    protected $hidden = [
        'location',
        'author_id',
        'status',
        'image',
        'slug',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'organizers:id,name,logo,slug',
        'categories:id,name',
        'themes:id,name,color',
        'linked_image',
    ];

    public static function boot() {
        parent::boot();
        static::creating(function($model) {
            // remove 'header' tags and content from body
            $model->body = preg_replace('~<header(.*?)</header>~Usi', "", $model->body);
        });
    }

    public function voyagerRoute($action)
    {
        return route('voyager.organizers.' . $action, $this->id);
    }

    public function getLinkAttribute()
    {
        return url('/actie/' . $this->slug);
    }

    public function getStartAttribute()
    {
        return Carbon::parse($this->start_date . " " . $this->start_time);
    }

    public function getEndAttribute()
    {
        return Carbon::parse($this->end_date . " " . $this->end_time);
    }

    public function getStartEndAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = Carbon::parse($this->start_date . " " . $this->start_time);
            $end = Carbon::parse($this->end_date . " " . $this->end_time);
            
            if ($this->start_date == $this->end_date) {
                // start and end on same day
                if ($this->start_time && $this->end_time) {
                    return $start->translatedFormat('j M Y, G:i') . '-' . $end->translatedFormat('G:i');
                } else if ($this->start_time) {
                    return $start->translatedFormat('j M Y, G:i');
                } else {
                    return $start->translatedFormat('j M Y');
                }
            } else if ($start->diffInDays($end) < 3) {
                // start and end < 3 days difference
                if ($this->start_time && $this->end_time) {
                    return $start->translatedFormat('j M Y, G:i') . ' ' . __('general.until') . ' ' . $end->translatedFormat('j M Y, G:i');
                } else if ($this->start_time) {
                    return $start->translatedFormat('j M Y, G:i') . ' ' . __('general.until') . ' ' . $end->translatedFormat('j M Y');
                } else {
                    return $start->translatedFormat('j M Y');
                }
            } else {
                // start and end >= 3 days difference
                return $start->translatedFormat('j M Y') . ' ' . __('general.until') . ' ' . $end->translatedFormat('j M Y');
            }
        }
        else if ($this->start_date) {
            $start = Carbon::parse($this->start_date . " " . $this->start_time);
            if ($this->start_time) {
                return $start->translatedFormat('j M Y, G:i');
            } else {
                return $start->translatedFormat('j M Y');
            }
        } else {
            return null;
        }
    }

    public function getStartUnixAttribute()
    {
        return Carbon::parse($this->start_date . " " . $this->start_time)->timestamp;
    }

    public function getPageviewsTextAttribute()
    {
        if ($this->pageviews) {
            if ($this->pageviews > 1000) {
                $rounded = round($this->pageviews / 1000, 1);
                return strval($rounded) . 'k';
            }
            return strval($this->pageviews);
        }
        return false;
    }

    public function getgeolocAttribute()
    {
        return $this->location;
    }

    public function setExterneLinkAttribute($value)
    {
        // check if value is array, then implode, else use as is
        if (is_array($value)) {
            $this->attributes['externe_link'] = implode(",", $value);
        } else {
            $this->attributes['externe_link'] = $value;
        }
    }

    public function getExterneLinkAttribute($value)
    {
        return explode(",", $value);
    }

    /**
     * Get a new query builder for the model's table.
     * Manipulate in case we need to convert geometrical fields to text.
     *
     * @param  bool $excludeDeleted
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery($excludeDeleted = true)
    {
        if (!empty($this->spatial) && $this->geometryAsText === true) {
            $raw = '';
            foreach ($this->spatial as $column) {
                $raw .= 'ST_AsText(`' . $this->table . '`.`' . $column . '`) as `' . $column . '`, ';
            }
            $raw = substr($raw, 0, -2);

            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }

        return parent::newQuery($excludeDeleted);
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function linked_image()
    {
        return $this->hasOne(Image::class)->without('actie');
    }

    public function report()
    {
        return $this->hasOne(Report::class)->without('actie');
    }

    public function getPublishedAttribute()
    {
        return $this->status === "PUBLISHED";
    }
    
    public function getAfgelopenAttribute()
    {
        if ($this->end_time === null) {
            // if end_time is not set, take the end of the day
            return Carbon::parse($this->end_date . " " . "23:59:59")->timestamp < time();
        }
        return Carbon::parse($this->end_date . " " . $this->end_time)->timestamp < time();
    }

    public function scopeNietAfgelopen($query)
    {
        // check if end_time is defined
        return $query->whereRaw("STR_TO_DATE(CONCAT(end_date, ' ', end_time), '%Y-%m-%d %H:%i:%s') > '" . Carbon::now()->toDateTimeString() . "'")
            ->orWhereRaw("(end_time is NULL AND STR_TO_DATE(end_date, '%Y-%m-%d') >= '" . Carbon::now()->toDateString() . "')");
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

    public function isPublished(): bool
    {
        return $this->status === 'PUBLISHED';
    }

    public function publish()
    {
        $this->status = 'PUBLISHED';
        $this->save();
    }
}