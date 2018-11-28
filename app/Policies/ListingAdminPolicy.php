<?php

namespace App\Policies;

use App\User;
use App\Models\Listing;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingAdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the listing.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $this->touch($user, 'view');
    }

    /**
     * Determine whether the user can create listings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->touch($user, 'create');
    }

    /**
     * Determine whether the user can update the listing.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->touch($user, 'update');
    }

    /**
     * Determine whether the user can delete the listing.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->touch($user, 'delete');
    }
    /**
     * Determine whether the user can perform any action on a listing.
     *
     * @param User $user
     * @param string $action
     * @return bool
     */
    public function touch(User $user, $action = 'touch')
    {
        $role = $user->roles()->where('slug', 'admin')
            ->orWhere('slug', 'editor')
            ->orWhere('slug', 'moderator')->wherePivot('expires_at', null)->first();

        if (isset($role)) {

            $policies = $role->policies;

            if (array_get($policies, 'Listings.model') == Listing::class) {
                $action = array_get($policies, 'Listings.actions.' . $action);

                return $action;
            }
        }

        return false;
    }
}
