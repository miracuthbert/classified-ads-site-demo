<?php

namespace App;

use App\Models\Listing;
use App\Models\Role;
use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, OrderableTrait, PivotOrderableTrait, Messagable, HasApiTokens;

    /**
     * The attributes that should be parsed as dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'last_login_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'phone', 'country', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get verified users.
     *
     * @return mixed
     */
    public function scopeIsVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Get unverified users.
     *
     * @return mixed
     */
    public function scopeIsNotVerified($query)
    {
        return $query->where('is_verified', false);
    }

    /**
     * Get users verification status.
     *
     * @return mixed
     */
    public function verified()
    {
        return $this->is_verified;
    }

    /**
     * Get user's last login time.
     *
     * @return mixed
     */
    public function last_login()
    {
        return !empty($this->last_login_at) ? $this->last_login_at->diffForHumans() : 'Unknown';
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles')->withTimestamps()
            ->withPivot(['expires_at']);
    }

    /**
     * Get listings owned by user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    /**
     * Get favourite listings for given user.
     *
     * @return mixed
     */
    public function favouriteListings()
    {
        return $this->morphedByMany(Listing::class, 'favouriteable')
            ->withPivot(['created_at'])
            ->orderByPivot('created_at', 'desc');
    }

    /**
     * Get viewed listings for given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function viewedListings()
    {
        return $this->morphedByMany(Listing::class, 'viewable', 'user_page_views')
            ->withTimestamps()
            ->withPivot(['updated_at', 'count', 'id']);
    }

}
