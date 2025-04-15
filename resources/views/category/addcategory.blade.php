@extends('layout.default')
@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('cdn/css/bootstrap.min.css') }}">
        <title>AddProduct</title>
    </head>
    <style>
        /* From Uiverse.io by gharsh11032000 */
        /* The switch - the box around the slider */
        .switch {
            font-size: 17px;
            position: relative;
            display: inline-block;
            width: 3.5em;
            height: 2em;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            border: 2px solid #414141;
            border-radius: 50px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 1.4em;
            width: 1.4em;
            left: 0.2em;
            bottom: 0.2em;
            background-color: rgb(0, 0, 0);
            border-radius: inherit;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .switch input:checked+.slider {
            box-shadow: 0 0 20px rgba(9, 117, 241, 0.8);
            border: 2px solid #0974f1;
        }

        .switch input:checked+.slider:before {
            transform: translateX(1.5em);
        }
    </style>

    <body>
        <form action="{{ isset($editCategory) ? route('update.category', $editCategory->id) : route('store.category') }}"
            method="POST">
            @csrf
            <div class="container mt-5">
                <div class="row mb-3">
                    <!-- Status Toggle -->
                    <div class="col-md-6">
                        <label for="statusToggle" class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="statusToggle" name="status"
                                {{ isset($editCategory) ? $editCategory->status == 1 ? 'checked' : '' : ''}}>
                            <label class="form-check-label" for="statusToggle" id="statusLabel">
                                {{ isset($editCategory) ? $editCategory->status == 1 ? 'Active' : 'InActive' : '' }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                    <input type="text" class="form-control" value="{{ isset($editCategory) ? $editCategory->name : '' }}"
                        name="name" aria-describedby="emailHelp">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </body>
@endsection
