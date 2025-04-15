@extends('layout.website.app')

@section('title', 'user orders')

@section('website')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Orders</h2>
        <div class="row">
            @include('layout.website.user-dashboard.user-account')
            <div class="col-lg-9">
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px">OrderNo</th>
                                    <th>Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Items</th>
                                    <th>Paymetn Method</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userOrders as $userOrder)
                                <tr>
                                    <td class="text-center">{{ $userOrder->order->id + 1000 }}</td>
                                    <td class="text-center">{{ $userOrder->order->name }}</td>
                                    <td class="text-center">{{ $userOrder->order->phone_no }}</td>
                                    <td class="text-center">{{ $userOrder->product->name }}</td>
                                    <td class="text-center">${{ $userOrder->total }}</td>
                                    <td class="text-center">{{ $userOrder->created_at }}</td>
                                    <td class="text-center">{{ $userOrder->qty }}</td>
                                    <td class="text-center">{{ $userOrder->order->paymetn_method }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('details.order.products', $userOrder->order->id) }}">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="fa fa-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
