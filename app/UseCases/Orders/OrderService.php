<?php


namespace App\UseCases\Orders;


use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderService
{
    public const ORDERS_BY_PAGE = 10;

    /**
     * @var OrderRepositoryInterface
     */
    private $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getOrderList($page)
    {
        return $this->repository->getAllPaginated($page, self::ORDERS_BY_PAGE);
    }
}
