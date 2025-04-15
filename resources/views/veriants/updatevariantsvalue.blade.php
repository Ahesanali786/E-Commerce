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
        <div class="container mt-5">
            <h1><strong>Add Products Veriants Value</strong></h1>
            <form action="{{ route('update.veriants.values', $editveriantsvalues->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                {{-- <div class="mt-3">
                    <img src="{{ asset('variant_images/'. $editveriantsvalues->image) }}" alt="image">
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control">
                    <span class="text-danger">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </span>

                    </span>
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Select Products <span class="text-danger">*</span></label>
                    <select class="form-control" name="Product_id" id="Product_id">
                        <option value="">--- Select Products ---</option>
                        @foreach ($products as $product)
                            <option
                                value="{{ $product->id }}"{{ $editveriantsvalues->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                    {{-- <span class="text-danger">
                @error('stander')
                    {{ $message }}
                @enderror
            </span> --}}
                </div>
                <div id="veriants">
                    <div class="veriants-group row mb-3">
                        <div class="col-md-3">
                            <select name="veriants_id[]" class="form-control variant-select" required>
                                <option value="">Select a Varianst</option>
                                @foreach ($veriants as $veriant)
                                    <option
                                        value="{{ $veriant->id }}"{{ $editveriantsvalues->attributes_id == $veriant->id ? 'selected' : '' }}>
                                        {{ $veriant->variant_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="name[]"
                                value="{{ $editveriantsvalues['variant_value'] ?? 'hello' }}" placeholder="veriants"
                                required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success add-more">
                                <i class="fa fa-plus"></i> Add More
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
        <script>
            $('#Product_id').change(function() {
                var product_id = this.value;
                var token = "{{ csrf_token() }}";

                $.ajax({
                    url: "{{ route('update.variants') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: token,
                        Product_id: product_id,
                    },
                    success: function(response) {
                        console.log(response);
                        let options = '<option value="">Select a Variant</option>';
                        response.forEach(function(item) {
                            options += `<option value="${item.id}">${item.variant_name}</option>`;
                        });
                        window.variantOptions = options;
                        $('.variant-select').html(options);
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.add-more').on('click', function() {
                    var newField = `
                        <div class="veriants-group row mb-3">
                            <div class="col-md-3">
                                <select name="veriants_id[]" class="form-control variant-select" required>
                                    ${window.variantOptions ?? '<option value="">Select a Variant</option>'}
                                      @foreach ($veriants as $veriant)
                                    <option
                                        value="{{ $veriant->id }}">
                                        {{ $veriant->variant_name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="name[]" class="form-control" placeholder="Variant" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-variants">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    `;
                    $('#veriants').append(newField);
                });

                $(document).on('click', '.remove-variants', function() {
                    $(this).closest('.veriants-group').remove();
                });
            });
        </script>
    </body>
@endsection
