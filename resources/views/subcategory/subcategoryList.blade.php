@extends('layout.default')
@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <style>
        .badge {
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
            text-align: center;
            margin: 0 auto;
            width: fit-content;
        }

        .badge-Active {
            color: rgb(255, 255, 255);
            background-color: #1c6e30;
            /* Light green background for Paid */
            border: 1px solid #c3e6cb;
        }

        .badge-InActive {
            color: rgb(249, 244, 244);
            background-color: #e40808;
            /* Light yellow background for Unpaid */
            border: 1px solid #ffeeba;
        }
    </style>

    <body>
        <div class="container mt-2">
            <h2 class="mt-3">All Category</h2>
            <table class="table mt-5" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">SBC-Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">SBC Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subCategory as $sbc)
                        <tr>
                            <th scope="row">{{ $sbc->id }}</th>
                            <td>{{ $sbc->name }}</td>
                            <td>{{ $sbc->Category->name }}</td>
                            <td>
                                @if ($sbc->status == 1)
                                    <span class="badge badge-Active">Active</span>
                                @else
                                    <span class="badge badge-InActive">InActive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('edit.sub.category', $sbc->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('delete.sub.category', $sbc->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-datatablescript/>
    </body>
@endsection
