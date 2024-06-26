<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Traits\Spatial;
use Voyager;

class Report extends Model
{
    use Spatial;

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

    public function getCoordinatesAttribute()
    {
        $coords = $this->getCoordinates();
        return (count($coords) === 0) ? null : $coords[0];
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
        $this->attributes['externe_link'] = implode(",", $value);
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
