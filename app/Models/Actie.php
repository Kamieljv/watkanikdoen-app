<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use TCG\Voyager\Traits\Spatial;
use Voyager;

class Actie extends Model
{
    use Spatial;

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

    public function getStartEndAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = Date::parse($this->start_date);
            $end = Date::parse($this->end_date);

            if ($start->format('Y-m-d') == $end->format('Y-m-d')) {
                // start and end on same day
                return $start->format('j M Y, G:i') . '-' . $end->format('G:i');
            } else if ($start->diffInDays($end) < 3) {
                // start and end < 3 days difference
                return $start->format('j M Y, G:i') . ' ' . __('general.until') . ' ' . $end->format('j M Y, G:i');
            } else {
                // start and end >= 3 days difference
                return $start->format('j M Y') . ' ' . __('general.until') . ' ' . $end->format('j M Y');
            }
        } else {
            return null;
        }
    }

    public function getStartUnixAttribute()
    {
        return Date::parse($this->start_date . " " . $this->start_time)->timestamp;
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
        $coords = $this->getCoordinates();
        if (count($coords) === 0) {
            return null;
        } else { 
            return [
                'lat' => floatval($coords[0]['lat']),
                'lng' => floatval($coords[0]['lng'])
            ];
        }
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

    public function getAfgelopenAttribute()
    {
        return Date::parse($this->time_end)->timestamp < time();
    }

    public function getPublishedAttribute()
    {
        return $this->status === "PUBLISHED";
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }
    public function scopeToekomstig($query)
    {
        return $query->where('time_end', '>', Date::now()->toDateTimeString());
    }

    public function publish()
    {
        $this->status = 'PUBLISHED';
        $this->save();
    }
}