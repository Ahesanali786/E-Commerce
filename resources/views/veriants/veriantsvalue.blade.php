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
        color: rgb(251, 255, 251);
        background-color: #1c6e30; /* Light green background for Paid */
        border: 1px solid #c3e6cb;
    }

    .badge-InActive {
        color: rgb(251, 247, 247);
        background-color: #e40808; /* Light yellow background for Unpaid */
        border: 1px solid #ffeeba;
    }
    img {
      border-radius: 50%;
      height: 70px;
      width: 80px;
    }
</style>
    <body>
        <div class="container">
            <h2 class="mt-3 mb-3"><strong>All Product_Variants</strong></h2>
            <div class="button">
                <a href="{{ route('create.veriants.velua') }}" class="btn btn-primary btn-sm mb-4">Add New Veriant Value</a>
            </div>
            <table class="table mt-5 ml-4" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Variants Name</th>
                        <th scope="col">Veriants Value Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($veriantsvalues as $veriantsvalue)
                        <tr>
                            <th scope="row">{{ $veriantsvalue->id }}</th>
                            <td>{{ $veriantsvalue->product->name }}</td>
                            <td>{{ $veriantsvalue->attribute->variant_name }}</td>
                            <td>{{ $veriantsvalue->variant_value }}</td>
                            <td>
                                <a href="{{ route('edit.veriants.velua', $veriantsvalue->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('delete.veriants.value', $veriantsvalue->id) }}" class="btn btn-danger btn-sm">
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
