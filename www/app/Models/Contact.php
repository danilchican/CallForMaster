<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'contacts';

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
        'website_url', 'email', 'skype', 'viber', 'icq', 'address'
    ];

    /**
     * An contacts is owned by a company.
     *
     * @return array
     */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * An groups is owned by a company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function groups()
    {
        return $this->hasOne(Social::class);
    }


    /**
     * An phone is owned by a contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
