<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'specializations';

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
        'name', 'slug', 'desc',
    ];

    /**
     * Getting companies belongs to specialization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'specialization_to_company', 'specialization_id', 'company_id');
    }

}
