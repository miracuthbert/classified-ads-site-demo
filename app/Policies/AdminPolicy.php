<?php

namespace App\Policies;

use App\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $this->touch($user, 'view');
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->touch($user, 'create');
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->touch($user, 'update');
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->touch($user, 'delete');
    }

    /**
     * Determine whether the user can perform any action on the admin.
     *
     * @param User $user
     * @param string $action
     * @return bool
     */
    public function touch(User $user, $action = 'touch')
    {
        $role = $user->roles()->where('slug', 'admin')->wherePivot('expires_at', null)->first();

        if (isset($role)) {

            $policies = $role->policies;

            if (array_get($policies, 'Admin.model') == Admin::class) {
                $action = array_get($policies, 'Admin.actions.' . $action);

                return $action;
            }
        }

        return false;
    }
}
