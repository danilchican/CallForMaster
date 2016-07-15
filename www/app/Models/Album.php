<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'albums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'description',
    ];

    /**
     * An albums is owned by a company.
     *
     * @return array
     */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * An photos is owned by a album.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
