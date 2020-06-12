<?php


namespace App\Repositories\Interfaces;


use App\Entities\Order;

interface OrderRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $page
     * @param int $ordersByPage
     * @return Order[]
     */
    public function getAllPaginated(int $page, int $ordersByPage): array;
}
