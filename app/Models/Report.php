<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Report extends Model
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

    protected $appends = [
        'coordinates',
    ];

    protected $fillable = [
        'user_id',
        'organizer_ids',
        'title',
        'body',
        'externe_link',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'location',
        'location_human',
        'image',
    ];

    protected $hidden = [
        'location',
    ];

    protected $with = [
        'linked_image',
    ];

    public function voyagerRoute($action)
    {
        return route('voyager.organizers.' . $action, $this->id);
    }

    /**
     * Accessor that mimics Eloquent dynamic property.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOrganizersAttribute()
    {
        if (!$this->relationLoaded('organizers')) {
            $organizers = Organizer::whereIn('id', $this->organizer_ids)->get();

            $this->setRelation('organizers', $organizers);
        }

        return $this->getRelation('organizers');
    }

    /**
     * Access organizers relation query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function organizers()
    {
        return Organizer::whereIn('id', $this->organizer_ids);
    }

    /**
     * Accessor for organizer_ids property.
     *
     * @return array
     */
    public function getOrganizerIdsAttribute($commaSeparatedIds)
    {
        return explode(',', $commaSeparatedIds);
    }

    /**
     * Mutator for organizer_ids property.
     *
     * @param  array|string $ids
     * @return void
     */
    public function setOrganizerIdsAttribute($ids)
    {
        $this->attributes['organizer_ids'] = is_string($ids) ? $ids : implode(',', $ids);
    }

    public function getCoordinatesAttribute()
    {
        return $this->location;
    }

    public function approve()
    {
        $this->status = 'APPROVED';
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->without('reports');
    }

    public function linked_image()
    {
        return $this->hasOne(Image::class)->without('report');
    }

    public function actie()
    {
        return $this->belongsTo(Actie::class)->without('report');
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
}
