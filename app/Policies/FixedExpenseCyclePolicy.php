<?php

namespace App\Policies;

use App\Models\FixedExpenseCycle;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FixedExpenseCyclePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FixedExpenseCycle $fixedExpenseCycle)
    {
        return $fixedExpenseCycle->fixedExpense->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FixedExpenseCycle $fixedExpenseCycle)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FixedExpenseCycle $fixedExpenseCycle)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FixedExpenseCycle $fixedExpenseCycle)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FixedExpenseCycle $fixedExpenseCycle)
    {
        //
    }
}
