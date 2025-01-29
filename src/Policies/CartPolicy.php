<?php

namespace Ccns\CcnsEcommerceCart\Policies;

use App\Models\User;
use Ccns\CcnsEcommerceCart\Models\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return false;
    }

    public function view(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id;
    }

    public function delete(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id;
    }

    public function restore(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id;
    }

    public function forceDelete(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id;
    }
}
