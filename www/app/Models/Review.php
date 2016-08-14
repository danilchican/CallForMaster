<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'author', 'email', 'advantages', 'disadvantages', 'phone'
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

}
