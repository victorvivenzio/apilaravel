<?php

namespace App\Policies;

use App\Traits\AdminActions;
use App\User;
use App\Buyer;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyerPolicy
{
    use HandlesAuthorization, AdminActions;

    /**
     * Determine whether the user can view the buyer.
     *
     * @param  \App\User  $user
     * @param  \App\buyer  $buyer
     * @return mixed
     */
    public function view(User $user, Buyer $buyer)
    {
        return $user->id === $buyer->id;
    }

    /**
     * Determine whether the user can delete the buyer.
     *
     * @param  \App\User  $user
     * @param  \App\buyer  $buyer
     * @return mixed
     */
    public function purchase(User $user, Buyer $buyer)
    {
        return $user->id === $buyer->id;
    }
}
