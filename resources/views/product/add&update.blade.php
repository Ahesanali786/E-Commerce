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
        <form action="{{ route('store.products') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container mt-2">
                <h1>Product Add </h1>
                <div class="mb-3">
                    <label class="form-label">Product Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control">
                    <span class="text-danger">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </span>

                    </span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Select Category <span class="text-danger">*</span></label>
                    <select class="form-control" name="category_id" id="ctgry">
                        <option value="">-- Select Department --</option>
                        @foreach ($Category as $ctgr)
                            <option value="{{ $ctgr->id }}">{{ $ctgr->name }}</option>
                        @endforeach

                    </select>
                    {{-- <span class="text-danger">
                @error('stander')
                    {{ $message }}
                @enderror
            </span> --}}
                </div>
                <div class="mb-3">
                    <label class="form-label">Select SubCategory <span class="text-danger">*</span></label>
                    <select class="form-control" name="sub_category_id" id="subCategory">
                        <option value="">-- Select Sub-Category --</option>
                    </select>
                    {{-- <span class="text-danger">
                @error('stander')
                    {{ $message }}
                @enderror
            </span> --}}
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price">
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea class="form-control" placeholder="Leave a comment here" name="description" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Product Description</label>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </body>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $('#ctgry').change(function() {
            var cid = this.value;
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('get.sub.category') }}",
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
    </script>
@endsection
