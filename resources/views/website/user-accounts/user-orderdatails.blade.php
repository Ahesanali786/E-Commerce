@extends('layout.user-dashboard.main')

@section('title', 'user orders')
@section('containt')
<style>
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* Full screen height */
    }

    .input-group {
        display: flex;
        width: 100%;
        max-width: 500px;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .input-group input[type="file"] {
        flex: 1;
        padding: 10px;
        border: none;
        outline: none;
    }

    .input-group .btn {
        padding: 10px 20px;
        border: none;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .input-group .btn:hover {
        background-color: #0056b3;
    }
</style>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Orders</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Orders</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <input type="hidden" name="error">
            <span class="text-danger">
                @error('error')
                <h5 style="color: red">
                    <strong>
                        {{ $message }}
                    </strong>
                </h5>
                @enderror
            </span>
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                </div>
            </div>
            <form action="{{ route('import.data') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <div class="input-group" style="width: 500px,height: 500px">
                        <input type="file" name="import_file" class="form-control">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
            <div class="input">
                <a href="{{ route('multi.order.download.excel') }}" class="btn btn-primary" style="font-size: 20px"><i
                        class="fa fa-download"></i>Export All Orders</a>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    <form method="POST" action="{{ route('order.download.excel') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary mb-6" style="font-size: 20px">
                            <i class="fa fa-download"></i> Exports Orders
                        </button>
                        <table class="table table-striped table-bordered data-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th style="width: 80px">OrderNo</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Items</th>
                                    <th>Payment Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($userOrders as $userOrder)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="order_ids[]" value="{{ $userOrder->id }}">
                                    </td>
                                    <td class="text-center">{{ $userOrder->order->id + 1000 }}</td>
                                    <td class="text-center">{{ $userOrder->order->address->name }}</td>
                                    <td class="text-center">{{ $userOrder->order->address->phone_no }}</td>
                                    <td class="text-center">{{ $userOrder->product->name }}</td>
                                    <td class="text-center">${{ $userOrder->total }}</td>
                                    <td class="text-center">{{ $userOrder->created_at }}</td>
                                    <td class="text-center">{{ $userOrder->qty }}</td>
                                    <td class="text-center">{{ $userOrder->order->payment_method }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('details.order.products', $userOrder->order->id) }}">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </form>

                </div>
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            </div>
        </div>
    </div>
</div>
<x-datatablescript />
{{-- <script type="text/javascript">
    $(document).ready(function() {
       $('#myTable').DataTable();
   });
</script> --}}
<script>
    document.getElementById('select-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('input[name="order_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>

<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.dashboard.orders.list') }}",
            columns: [
                { data: 'select', name: 'select', orderable: false, searchable: false },
                { data: 'Order_id', name: 'Order_id' },
                { data: 'name', name: 'name' },
                { data: 'phone', name: 'phone' },
                { data: 'product_name', name: 'product_name' },
                { data: 'total', name: 'total' },
                { data: 'created_at', name: 'created_at' },
                { data: 'qty', name: 'qty' },
                { data: 'payment_method', name: 'payment_method' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>

@endsection
