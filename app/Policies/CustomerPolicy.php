<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Customer $customer): bool
    {
        //
        return in_array($user->email, [
            'admin@admin.com', // these users who can view
            
        ]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->email, [
            'admin@admin.com', // these users who can create
            'admin2@admin.com', // these users who can create
        ]); //403 THIS ACTION IS UNAUTHORIZED.
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Customer $customer): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Customer $customer): bool
    {
        //
        return in_array($user->email, [
            'admin@admin.com', // these users who can create
            
        ]); //403 THIS ACTION IS UNAUTHORIZED.
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Customer $customer): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Customer $customer): bool
    {
        //
    }
}
