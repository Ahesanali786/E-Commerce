<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="width: 80px">OrderNo</th>
            <th class="text-center">User Name</th>
            <th class="text-center">Phone</th>
            <th class="text-center">Product Name</th>
            <th class="text-center">Total</th>
            <th class="text-center">Order Date</th>
            <th class="text-center">Quantity</th>
            <th>Paymetn Method</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userOrders as $userOrder)
        <tr>
            <td class="text-center">{{ $userOrder->order->id + 1000 }}</td>
            <td class="text-center">{{ $userOrder->order->address->name }}</td>
            <td class="text-center">{{ $userOrder->order->address->phone_no }}</td>
            <td class="text-center">{{ $userOrder->product->name }}</td>
            <td class="text-center">${{ $userOrder->total }}</td>
            <td class="text-center">{{ $userOrder->created_at }}</td>
            <td class="text-center">{{ $userOrder->qty }}</td>
            <td class="text-center">{{ $userOrder->order->payment_method }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
