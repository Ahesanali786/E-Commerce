@extends('layout.default')
@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>


    </head>
    <style>
        img {
            height: 50px;
            width: 50px;
            border-radius: 60px;
        }
    </style>
    <body>
        <div class="container mt-2">
            <h2 class="mt-3">All Products</h2>
            <table class="table mt-5" id="myTable" >
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">SubCategory Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>
                                <img src="{{ asset('Product_image/' . $product->image) }}" alt="">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->subCategory->Category->name ?? '-' }}</td>
                            <td>{{ $product->subCategory->name ?? '-' }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="{{ route('edit.product', $product->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger btn-sm">
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
