<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Listing extends Model
{
    use SoftDeletes, OrderableTrait, PivotOrderableTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get live listing(s).
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsLive($query)
    {
        return $query->where('live', true);
    }

    /**
     * Get listing(s) not live.
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsNotLive($query)
    {
        return $query->where('live', false);
    }

    /**
     * Get listings in given category.
     *
     * @param $query
     * @param Category $category
     * @return mixed
     */
    public function scopeFromCategory($query, Category $category)
    {
        return $query->where('category_id', $category->id);
    }

    /**
     * Get listings in given area and its descendants.
     *
     * @param $query
     * @param Area $area
     * @return mixed
     */
    public function scopeInArea($query, Area $area)
    {
        return $query->whereIn('area_id', array_merge(
            [$area->id],
            $area->descendants->pluck('id')->toArray()
        ));
    }

    /**
     * Get listing status.
     *
     * @return mixed
     */
    public function live()
    {
        return $this->live;
    }

    /**
     * Get listing price.
     *
     * @return mixed
     */
    public function cost()
    {
        return $this->category->price;
    }

    /**
     * Check if listing owned by given user.
     *
     * @param User $user
     * @return bool
     */
    public function ownedByUser(User $user)
    {
        return $this->user->id === $user->id;
    }

    public function toSearchableArray()
    {
        $properties = $this->toArray();

        //get listing created_at time in carbon
        $properties['created_at_human'] = $this->created_at->diffForHumans();

        //get user
        $properties['user'] = $this->user;

        //get category
        $properties['category'] = $this->category;

        //get area
        $properties['area'] = $this->area;

        return $properties;
    }


    /**
     * Get user that owns the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the area that owns the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get favouriteables owned by listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function favourites()
    {
        return $this->morphToMany(User::class, 'favouriteable');
    }

    /**
     * Get user that favourited the listing.
     *
     * @param User $user
     * @return mixed
     */
    public function favouritedBy(User $user)
    {
        return $this->favourites->contains($user);
    }

    /**
     * Get users who viewed listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function viewedUsers()
    {
        return $this->morphToMany(User::class, 'viewable', 'user_page_views')->withTimestamps()->withPivot(['count']);
    }

    public function views()
    {
        return array_sum($this->viewedUsers->pluck('pivot.count')->toArray());

        //option 2
        //return $this->viewedUsers()->sum('count');
    }

}
