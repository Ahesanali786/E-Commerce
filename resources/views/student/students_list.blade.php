@extends('layout.default')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Studets Data</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <link href="{{ asset('cdn/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('cdn/css/dataTables.bootstrap5.min.css') }}"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        {{-- <script src="{{ asset('cdn/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('cdn/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('cdn/js/dataTables.bootstrap5.min.js') }}"></script> --}}
    </head>
    <style>
        img {
            height: 50px;
            width: 50px;
            border-radius: 60px;
        }
    </style>

    <body>
        {{-- @extends('layout.toaster') --}}
        {{-- <x-sweetalert /> --}}
        <div class="col-lg-12">
            <div class="table-responsive">
                <div class="container mt-2 ">
                    <h1>Students Details</h1>
                    <table id="myTable" class="table table-hover  table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">City</th>
                                <th scope="col">Age</th>
                                {{-- <th scope="col">Hobbies</th> --}}
                                <th scope="col">Gender</th>
                                <th scope="col">Stander</th>
                                <th scope="col">S-Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student as $std)
                                <tr>
                                    <td><a href="{{ route('students.data', $std->id) }}">{{ $std->id }}</a></td>
                                    <td>{{ $std->name }}</td>
                                    <td>{{ $std->email }}</td>
                                    <td>{{ $std->city }}</td>
                                    <td>{{ $std->age }}</td>
                                    {{-- <td>{{ $std->hobbies }}</td> --}}
                                    <td>{{ $std->gender }}</td>
                                    <td>{{ $std->stander }}</td>
                                    <td>
                                        <img src="{{ asset('webimg/' . $std->image) }}" alt="no image">
                                    </td>
                                    <td>
                                        <a href="{{ route('students.edit', $std->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" id="delete-user"
                                            data-url="{{ route('student.delet', $std->id) }}"
                                            class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script> --}}
        <x-datatablescript/>
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('body').on('click', '#delete-user', function() {

                    var userURL = $(this).data('url');
                    var trObj = $(this);
                    if (confirm("Are you sure you want to remove this user?") == true) {
                        $.ajax({
                            url: userURL,
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(data) {
                                // alert(data.success);
                                toastr.success(data.success);
                                trObj.parents("tr").remove();
                            }
                        });
                    }
                });
            });
        </script>
    </body>
@endsection
