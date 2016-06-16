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
