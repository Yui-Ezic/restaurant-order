<?php /**@var $orders \App\Entities\Order[] */ ?>

<table>
    <thead>
    <tr>
        <th> Id</th>
        <th> Customer name</th>
        <th> Status</th>
        <th> Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td> {{$order->getId()}} </td>
            <td> {{$order->getCustomer()->getFullName()}} </td>
            <td> {{$order->getStatus()}} </td>
            <td> {{$order->getDate()->format('d.m.y')}} </td>
        </tr>
    @endforeach
    </tbody>
</table>
