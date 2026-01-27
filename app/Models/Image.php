<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $primaryKey = 'key';

    protected $fillable = [
        'path',
        'user_id',
        'actie_id',
        'organizer_id',
        'report_id',
        'referentie_id',
    ];

    protected $appends = [
        'url',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->key = md5($model->path); // has filepath as key
            $model->size = filesize(storage_path('app/public/' . $model->path)) / 1000; // compute size in kB
        });
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->without('linked_image');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class)->without('linked_image');
    }

    public function actie()
    {
        return $this->belongsTo(Actie::class)->without('linked_image');
    }

    public function report()
    {
        return $this->belongsTo(Report::class)->without('linked_image');
    }

    public function referentie()
    {
        return $this->belongsTo(Referentie::class)->without('linked_image');
    }


    public function linkedModel()
    {
        $links = array_values(array_filter([
            $this->user,
            $this->organizer,
            $this->actie,
            $this->report,
            $this->referentie,
        ]));
        return $links ? $links[0] : null;
    }

    public function scopeHasLink($query)
    {
        return $query->where('user_id', '!=', null)
                ->orWhere('organizer_id', '!=', null)
                ->orWhere('actie_id', '!=', null)
                ->orWhere('report_id', '!=', null)
                ->orWhere('referentie_id', '!=', null);
    }

    public function scopeNotHasLink($query)
    {
        return $query->whereNull('user_id')
                ->whereNull('organizer_id')
                ->whereNull('actie_id')
                ->whereNull('report_id')
                ->whereNull('referentie_id');
    }
}
