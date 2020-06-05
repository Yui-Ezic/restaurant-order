<?php


namespace App\Entities;


class Customer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $full_name;

    /**
     * @var string
     */
    private $phone;

    /**
     * Customer constructor.
     * @param int $id
     * @param string $full_name
     * @param string $phone
     */
    public function __construct(int $id, string $full_name, string $phone)
    {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->phone = $phone;
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
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
