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
        <div class="container mt-5">
            <h1>Add SubCategories</h1>
            <form action="{{ route('store.sub.category') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <!-- Status Toggle -->
                    <div class="col-md-6">
                        <label for="statusToggle" class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="statusToggle" name="status">
                            <label class="form-check-label" for="statusToggle" id="statusLabel">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-5">
                    <label for="exampleInputEmail1" class="form-label">Sub-Category Name</label>
                    <input type="text" class="form-control" name="name" placeholder="-- SubCategories Name --">
                </div>
                <div class="mb-3">
                    <label class="form-label">Select Category <span class="text-danger">*</span></label>
                    <select class="form-control" name="category_id" id="stander">
                        <option value="">--- Select SubCategories ---</option>
                        @foreach ($Category as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                    {{-- <span class="text-danger">
                @error('stander')
                    {{ $message }}
                @enderror
            </span> --}}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
@endsection
