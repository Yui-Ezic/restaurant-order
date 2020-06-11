<?php

namespace App\Events;

use App\Entities\Order;

class OrderConfirmed
{
    /**
     * @var Order
     */
    private $order;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
