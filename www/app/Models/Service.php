<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tariff_services';

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
    protected $fillable = ['title'];

    /**
     * Set title of the Service obj.
     *
     * @param $title
     * @return mixed
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set the relation between services and tariff.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tariffs()
    {
        return $this->belongsToMany(Tariff::class, 'service_to_tariff', 'service_id', 'tariff_id');
    }
}
