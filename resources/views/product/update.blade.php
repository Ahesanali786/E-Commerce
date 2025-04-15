@extends('layout.default')
@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('cdn/css/bootstrap.min.css') }}">
        <title>AddProduct</title>
    </head>

    <body>
        <form action="{{ route('update.product', $products->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container mt-5">
                <h1>Product Add </h1>
                <div class="mb-1">
                    <img src="{{ isset($products) ? asset('Product_image/' . $products->image) : '' }}"
                        alt="{{ isset($products) ? $products->name : '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <div class="mb-3">
                    <label class="form-label">Select Category <span class="text-danger">*</span></label>
                    <select class="form-control" name="category_id" id="ctgry">
                        <option value="">-- Select Category --</option>
                        @foreach ($Category as $ctgr)
                            <option value="{{ $ctgr->id }}"
                                {{ $products->subCategory->category_id == $ctgr->id ? 'selected' : '' }}>
                                {{ $ctgr->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Select SubCategory <span class="text-danger">*</span></label>
                    <select class="form-control" name="sub_category_id" id="subCategory">
                        @foreach ($subCategorys as $sbc)
                        <option value="{{ $sbc->id }}"{{ $products->subCategory->id == $sbc->id ? 'selected' : ''}}>{{ $sbc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Product Name</label>
                    <input type="text" class="form-control" value="{{ $products->name }}" name="name"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Product Price</label>
                    <input type="text" class="form-control" value="{{ $products->price }}" name="price">
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea class="form-control" placeholder="Leave a Product Description" name="description">{{ $products->description }}</textarea>
                    <label for="floatingTextarea">Product Description</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // $('document').ready(function(){
        //     $("#subCategory").trigger("change");
        //     $("#ctgry").trigger("change");
        $('#ctgry').change(function() {
            var cid = this.value;
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('get.subcategory') }}",
                type: "POST",
                datatype: "json",
                data: {
                    _token: token,
                    Category_id: cid,
                },
                success: function(response) {
                    if (response.length) {
                        $("#subCategory").empty();
                        response.forEach(el => {
                            $("#subCategory").append(
                                `<option value='${el.id}'> ${el.name}</option>`)
                        });
                    }
                },
                errror: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
        // })
    </script>
@endsection
