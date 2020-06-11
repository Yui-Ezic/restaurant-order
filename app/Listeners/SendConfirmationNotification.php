<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Services\Sms\SmsSender;

class SendConfirmationNotification
{
    /**
     * @var SmsSender
     */
    private $smsSender;

    /**
     * Create the event listener.
     *
     * @param SmsSender $smsSender
     */
    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    /**
     * Handle the event.
     *
     * @param OrderConfirmed $event
     * @return void
     */
    public function handle(OrderConfirmed $event)
    {
        $order = $event->getOrder();
        $customer = $order->getCustomer();
        $this->smsSender->send($customer->getPhone(), 'Order #' . $order->getId() . ' has been confirmed.');
    }
}
