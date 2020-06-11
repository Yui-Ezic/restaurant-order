<?php


namespace App\Entities;


use App\Events\OrderConfirmed;
use DateTimeImmutable;

class Order
{
    private const STATUS_NEW = 'New';
    private const STATUS_CONFIRMED = 'Confirmed';
    private const STATUS_CANCELED = 'Canceled';
    private const STATUS_PAID = 'Paid';
    private const STATUS_COMPLETED = 'Completed';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * Order constructor.
     * @param int $id
     * @param string $status
     * @param DateTimeImmutable $date
     * @param Customer $customer
     */
    public function __construct(int $id, string $status, DateTimeImmutable $date, Customer $customer)
    {
        $this->id = $id;
        $this->status = $status ?: self::STATUS_NEW;
        $this->date = $date;
        $this->customer = $customer;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function confirm(): void
    {
        $this->status = self::STATUS_CONFIRMED;
        event(new OrderConfirmed($this));
    }

    public function pay(): void
    {
        $this->status = self::STATUS_PAID;
    }

    public function cancel(): void
    {
        $this->status = self::STATUS_CANCELED;
    }

    public function complete(): void
    {
        $this->status = self::STATUS_COMPLETED;
    }
}
