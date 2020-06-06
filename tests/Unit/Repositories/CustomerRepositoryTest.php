<?php


namespace Repositories;


use App\Entities\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CustomerRepositoryTest extends TestCase
{
    use WithFaker;

    private function getCustomer(): Customer
    {
        return new Customer(
            $this->faker->unique()->randomDigitNotNull,
            $this->faker->name,
            $this->faker->phoneNumber
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        DB::clearResolvedInstances();
        $this->setUpFaker();
    }

    public function testCreate(): void
    {
        $customer = $this->getCustomer();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('insert')
            ->with([
                'id' => $customer->getId(),
                'full_name' => $customer->getFullName(),
                'phone' => $customer->getPhone()
            ])
            ->willReturn(true);

        $repository = new CustomerRepository();
        $repository->create($customer);
    }

    public function testUpdate()
    {
        $customer = $this->getCustomer();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('where')
            ->with('id', $customer->getId())
            ->willReturn($qb);

        $qb->expects($this->once())
            ->method('update')
            ->with([
                'full_name' => $customer->getFullName(),
                'phone' => $customer->getPhone()
            ])
            ->willReturn(true);

        $repository = new CustomerRepository();
        $repository->update($customer);
    }

    public function testFindById()
    {
        $customer = $this->getCustomer();

        $qb = $this->createMock(Builder::class);

        DB::shouldReceive('table')
            ->andReturn($qb);

        $qb->expects($this->once())
            ->method('where')
            ->with('id', $customer->getId())
            ->willReturn($qb);

        $result = (object)[
            'id' => $customer->getId(),
            'full_name' => $customer->getFullName(),
            'phone' => $customer->getPhone()
        ];

        $qb->expects($this->once())
            ->method('first')
            ->willReturn($result);

        $repository = new CustomerRepository();
        $customer2 = $repository->findById($customer->getId());

        $this->assertEquals($customer->getId(), $customer2->getId());
        $this->assertEquals($customer->getFullName(), $customer2->getFullName());
        $this->assertEquals($customer->getPhone(), $customer2->getPhone());
    }
}
