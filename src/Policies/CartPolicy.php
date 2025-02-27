<?php

namespace Ccns\CcnsEcommerceCart\Policies;

use App\Models\User;
use Ccns\CcnsEcommerceCart\Models\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function viewCart(?User $user): bool
    {
        return ! ($user === null);
    }

    public function clearCart(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id && $cart->items()->count() !== 0;
    }
}
