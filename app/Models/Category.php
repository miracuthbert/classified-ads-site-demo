<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = ['name', 'slug', 'price', 'details'];

    /**
     * Get the route key for the model.
     * Use 'slug' instead of id
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param $query
     * @param $area
     */
    public function scopeWithListingsInArea($query, Area $area)
    {
        return $query->withCount([
            'listings' => function ($query) use ($area) {
                $query->isLive()->inArea($area);
            },
        ])->with([
            'listings' => function ($query) use ($area) {
                $query->isLive()->inArea($area);
            },
        ]);
    }

    /**
     * Fetch listings owned by category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

}
