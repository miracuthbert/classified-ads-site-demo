<?php

namespace App\Models;

use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use OrderableTrait, PivotOrderableTrait;

    /**
     * The attributes that should be cast to native types.
     *
     * @var $casts
     */
    protected $casts = [
        'policies' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['expires_at'];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles')->withTimestamps();
    }
}
