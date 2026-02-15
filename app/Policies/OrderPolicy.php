<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;

class OrderPolicy
{
    public function view(User $user, Order $order): bool {
        return $user->is($order->user) || $user->isStaff();
    }

    public function cancel(User $user, Order $order): bool {
        return ($user->is($order->user) || $user->isStaff()) && $order->canChangeStatus();
    }
}
