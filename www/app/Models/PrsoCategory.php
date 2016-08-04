<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class PrsoCategory extends Model
{
    use NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'slug', 'desc',  'parent_id', '_lft', '_rgt',
    ];

    /**
     * Getting companies for a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_to_category', 'category_id', 'company_id');
    }

    /**
     *
     * Search category by keyword.
     *
     * @param $query
     * @param $keyword
     * @return mixed
     */

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("desc", "LIKE", "%$keyword%")
                    ->orWhere("slug", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
