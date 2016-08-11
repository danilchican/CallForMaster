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
        'name', 'description', 'logo_url', 'unp_number', 'slug', 'status'
    ];

    /**
     * An company is owned by a user.
     *
     * @return array
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An contacts is owned by a company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function contacts()
    {
        return $this->hasOne(Contact::class);
    }

    /**
     * An albums is owned by a company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    /**
     * Getting photos for a company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */

    public function photos()
    {
        return $this->hasManyThrough(Photo::class, Album::class);
    }

    /**
     * Getting specializations for a company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'specialization_to_company', 'company_id', 'specialization_id');
    }

    /**
     * Getting categories for a company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function categories()
    {
        return $this->belongsToMany(PrsoCategory::class, 'company_to_category', 'company_id', 'category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', '=', 2);
    }
}
