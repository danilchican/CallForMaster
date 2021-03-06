<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'photos';

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
        'image_url', 'title', 'description'
    ];

    /**
     * An photo is owned by a album.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function albums()
    {
        return $this->belongsTo(Album::class);
    }

    public function user()
    {
        return $this->belongsTo(Company::class);
    }
}
