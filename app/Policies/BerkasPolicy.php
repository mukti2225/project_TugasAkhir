<?php

namespace App\Policies;

use App\Models\Berkas;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BerkasPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Berkas $berkas): bool
    {
         if ($user->hasRole('admin')) {
            return false;
        }

        return $berkas->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         if ($user->hasRole('admin')) {
            return false;
        }

        return $user->berkas()->count() === 0;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Berkas $berkas): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Berkas $berkas): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Berkas $berkas): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Berkas $berkas): bool
    {
        return false;
    }
}
