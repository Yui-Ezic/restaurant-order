<?php


namespace App\Repositories;


use App\Entities\Order;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use DateTimeImmutable;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * OrderRepository constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return Order[]
     */
    public function getAll(): array
    {
        $result = $this->getConnection()->get();
        $orders = [];

        foreach ($result as $order) {
            $customer = $this->customerRepository->findById($order->customer_id);
            $orders[] = new Order($order->id, $order->status, new DateTimeImmutable($order->date), $customer);
        }

        return $orders;
    }

    /**
     * @return Builder
     */
    private function getConnection(): Builder
    {
        return DB::table('orders');
    }

    /**
     * @param int $id
     * @return Order
     * @throws Exception
     */
    public function findById(int $id): Order
    {
        $order = $this->getConnection()->where('id', $id)->first();

        if ($order === null) {
            throw new RuntimeException('Can\'t find order with id = ' . $id);
        }

        $customer = $this->customerRepository->findById($order->customer_id);
        return new Order($order->id, $order->status, new DateTimeImmutable($order->date), $customer);
    }

    /**
     * @param Order $item
     */
    public function create($item)
    {
        if ($item instanceof Order) {
            $this->getConnection()->insert([
                'id' => $item->getId(),
                'status' => $item->getStatus(),
                'date' => $item->getDate()->format('Y-m-d H:i:s'),
                'customer_id' => $item->getCustomer()->getId()
            ]);
        }

        throw new InvalidArgumentException('Cannot create non Order class: ' . get_class($item));
    }

    /**
     * @param Order $item
     */
    public function update($item)
    {
        if ($item instanceof Order) {
            $this->getConnection()->where('id', $item->getId())->update([
                'status' => $item->getStatus(),
                'date' => $item->getDate()->format('Y-m-d H:i:s'),
                'customer_id' => $item->getCustomer()->getId()
            ]);
        }

        throw new InvalidArgumentException('Cannot create non Order class: ' . get_class($item));
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->getConnection()->delete($id);
    }
}
