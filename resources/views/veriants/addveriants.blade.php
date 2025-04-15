@extends('layout.default')
@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('cdn/css/bootstrap.min.css') }}">
        <title>AddProduct</title>
    </head>

    <body>
        {{-- {{ dd($editveriant) }} --}}
        <form action="{{ isset($editveriant) ? route('update.veriants',$editveriant->id) : route('store.veriants') }}" method="POST">
            @csrf
            <div class="container mt-5">
                <div class="header mb-3">
                    <h1><strong>Add_Product Veriants</strong></h1>
                </div>
                <div class="mb-3">
                    <label class="form-label">Select Products <span class="text-danger">*</span></label>
                    <select class="form-control" name="Product_id">
                        <option value="">--- Select Products ---</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"{{ isset($editveriant) ? $editveriant->product_id == $product->id ? 'selected' : '' : ''}}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('Product_id')
                            <strong>
                                {{ $message }}
                            </strong>
                        @enderror
                    </span>
                </div>
                <div id="veriants">
                    <div class="veriants-group row mb-3">
                        <div class="mb-3">
                            <label for="veriant" class="form-label">Variant Name</label>
                            <input type="text" class="form-control"
                                value="{{ isset($editveriant) ? $editveriant->variant_name : '' }}" name="name[]">
                            <span class="text-danger">
                                @error('name')
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success add-more">
                                <i class="fa fa-plus"></i> Add More
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <script>
            $(document).ready(function() {
                // Add more ingredients functionality
                $('.add-more').on('click', function() {
                    var newIngredientRow = `
                        <div class="veriants-group row mb-3">
                            <div class="mb-3">
                                <label for="veriant" class="form-label">Variant Name</label>
                                <input type="text" class="form-control" name="name[]">
                                <span class="text-danger">
                                    @error('name')
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-ingredient">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>`;
                    $('#veriants').append(newIngredientRow);
                });
                $(document).on('click', '.remove-ingredient', function() {
                    $(this).closest('.veriants-group').remove();
                });
            });
        </script>
    </body>
@endsection
