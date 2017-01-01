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
}
