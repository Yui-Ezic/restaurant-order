<?php


namespace App\Repositories;


use App\Entities\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @return Customer[]
     */
    public function getAll(): array
    {
        $result = $this->getConnection()->get();
        $customers = [];

        foreach ($result as $customer) {
            $customers[] = new Customer($customer->id, $customer->full_name, $customer->phone);
        }

        return $customers;
    }

    /**
     * @return Builder
     */
    private function getConnection(): Builder
    {
        return DB::table('customers');
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function findById(int $id): Customer
    {
        $customer = $this->getConnection()->where('id', $id)->first();

        if ($customer === null) {
            throw new RuntimeException('Can\'t find customer with id = )' . $id);
        }

        return new Customer($customer->id, $customer->full_name, $customer->phone);
    }

    /**
     * @param Customer $item
     */
    public function create($item)
    {
        if ($item instanceof Customer) {
            $this->getConnection()->insert([
                'id' => $item->getId(),
                'full_name' => $item->getFullName(),
                'phone' => $item->getPhone()
            ]);
            return;
        }

        throw new InvalidArgumentException('Cannot create non Order class: ' . get_class($item));
    }

    /**
     * @param Customer $item
     */
    public function update($item)
    {
        if ($item instanceof Customer) {
           $this->getConnection()->where('id', $item->getId())->update([
                'full_name' => $item->getFullName(),
                'phone' => $item->getPhone()
            ]);
            return;
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
