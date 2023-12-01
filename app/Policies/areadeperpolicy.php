<?php

namespace App\Policies;

use App\Models\User;
use App\Models\areadeper;
use Illuminate\Auth\Access\Response;

class areadeperpolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_areadeper');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, areadeper $areadeper): bool
    {
        return $user->can('view_areadeper');//
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_areadeper'); //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, areadeper $areadeper): bool
    {
        return $user->can('update_areadeper');//
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, areadeper $areadeper): bool
    {
        return $user->can('delete_areadeper'); //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restoredelete(User $user, areadeper $areadeper): bool
    {
        return $user->can('delete_any_areadeper');//
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, areadeper $areadeper): bool
    {
        return $user->can('force_delete_areadeper');//
    }


 /**
     * Determine whether the user can permanently bulk delete.
     *
 
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_areadeper');
    }

 /**
     * Determine whether the user can restore.
     *
    
     */
    public function restore(User $user, areadeper $areadeper): bool
    {
        return $user->can('restore_areadeper');
    }
     
   

    /**
     * Determine whether the user can bulk restore.
     *
     * 
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_areadeper');
    }

    /**
     * Determine whether the user can replicate.
     *
     *
     */
    public function replicate(User $user, areadeper $areadeper): bool
    {
        return $user->can('replicate_areadeper');
    }

    /**
     * Determine whether the user can reorder.
     *
    
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_areadeper');
    }









}
