<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'companies';

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
        'name', 'description', 'logo_url'
    ];

    /**
     * An company is owned by a user.
     *
     * @return array
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function contacts()
    {
        return $this->hasOne('App\Models\Contact');
    }
}
