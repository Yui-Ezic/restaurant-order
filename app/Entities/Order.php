<?php


namespace App\Entities;


use DateTimeImmutable;

class Order
{
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
}
