<?php

namespace App\Policies;

use App\User;
use App\Models\Listing;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the listing.
     *
     * @param  \App\User $user
     * @param  \App\Models\Listing $listing
     * @return mixed
     */
    public function view(User $user, Listing $listing)
    {
        return $this->touch($user, $listing);
    }

    /**
     * Determine whether the user can create listings.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the listing edit form.
     *
     * @param  \App\User $user
     * @param Listing $listing
     * @return mixed
     */
    public function edit(User $user, Listing $listing)
    {
        return $this->touch($user, $listing);
    }

    /**
     * Determine whether the user can update the listing.
     *
     * @param  \App\User $user
     * @param  \App\Models\Listing $listing
     * @return mixed
     */
    public function update(User $user, Listing $listing)
    {
        return $this->touch($user, $listing);
    }

    /**
     * Determine whether the user can delete the listing.
     *
     * @param  \App\User $user
     * @param  \App\Models\Listing $listing
     * @return mixed
     */
    public function delete(User $user, Listing $listing)
    {
        return $this->touch($user, $listing);
    }

    /**
     * Determine whether the user can perform any action on the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function touch(User $user, Listing $listing)
    {
        return $listing->ownedByUser($user);
    }
}
