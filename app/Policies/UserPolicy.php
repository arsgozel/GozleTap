<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function categories(User $user)
    {
        return $this->checkPermission($user, 1);
    }

    public function brands(User $user)
    {
        return $this->checkPermission($user, 2);
    }

    public function attributes(User $user)
    {
        return $this->checkPermission($user, 3);
    }

    public function products(User $user)
    {
        return $this->checkPermission($user, 4);
    }

    public function orders(User $user)
    {
        return $this->checkPermission($user, 5);
    }

    public function customers(User $user)
    {
        return $this->checkPermission($user, 6);
    }

    public function verifications(User $user)
    {
        return $this->checkPermission($user, 7);
    }

    public function locations(User $user)
    {
        return $this->checkPermission($user, 8);
    }

    public function users(User $user)
    {
        return $this->checkPermission($user, 9);
    }

    public function authAttempts(User $user)
    {
        return $this->checkPermission($user, 10);
    }

    public function ipAddresses(User $user)
    {
        return $this->checkPermission($user, 11);
    }

    public function userAgents(User $user)
    {
        return $this->checkPermission($user, 12);
    }


    protected function checkPermission($user, $id)
    {
        return in_array($id, $user->permissions ?: []);
    }
}
