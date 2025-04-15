@extends('layout.default')
@section('content')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link rel='stylesheet' href='{{ asset('cdn/css/bootstrap.min.css') }}'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='{{ asset('cdn/css/all.min.css') }}'>

<style>
    body {
        padding: 0;
        margin: 0;
        font-family: 'Lato', sans-serif;
        color: #000;
    }

    .student-profile .card {
        border-radius: 10px;
    }

    .student-profile .card .card-header .profile_img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin: 10px auto;
        border: 10px solid #ccc;
        border-radius: 50%;
    }

    .student-profile .card h3 {
        font-size: 20px;
        font-weight: 700;
    }

    .student-profile .card p {
        font-size: 16px;
        color: #000;
    }

    .student-profile .table th,
    .student-profile .table td {
        font-size: 14px;
        padding: 5px 10px;
        color: #000;
    }
    .img{
        size: 100px;
    }
</style>
<div class="student-profile py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent text-center">
                        <img class="profile_img" src="{{ asset('webimg/' . $show_data->image) }}" alt="student dp">
                        <h3>{{ $show_data->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><strong class="pr-1">Student ID:</strong>{{ $show_data->id }}</p>
                        <p class="mb-0"><strong class="pr-1">Class:</strong>{{ $show_data->stander }}</p>
                        <p class="mb-0"><strong class="pr-1">Section:</strong>A</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Email</th>
                                <td width="2%">:</td>
                                <td>{{ $show_data->email }}</td>
                            </tr>
                            <tr>
                                <th width="30%">City</th>
                                <td width="2%">:</td>
                                <td>{{ $show_data->city }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Gender</th>
                                <td width="2%">:</td>
                                <td>{{ $show_data->gender }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Hobbies</th>
                                <td width="2%">:</td>
                                <td>{{ $show_data->hobbies }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Age</th>
                                <td width="2%">:</td>
                                <td>{{ $show_data->age }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="height: 26px"></div>
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Other Information</h3>
                    </div>
                    <div class="card-body pt-0">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
