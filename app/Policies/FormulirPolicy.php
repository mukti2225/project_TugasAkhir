<?php

namespace App\Policies;

use App\Models\Formulir;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FormulirPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Formulir $formulir): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return $formulir->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return $user->formulir()->count() === 0;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Formulir $formulir): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Formulir $formulir): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Formulir $formulir): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Formulir $formulir): bool
    {
        return $user->hasRole('admin');
    }
}
