<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    /**
     * @var string
     */
    protected $table = 'tariffs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title', 'whom', 'additional_service', 'top', 'published',
    ];

    /**
     * Get all published tariffs
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', '=', true);
    }

    /**
     * Set the relation between services and tariff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_to_tariff', 'tariff_id', 'service_id');
    }

    /**
     * Get the prices of the current tariff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
