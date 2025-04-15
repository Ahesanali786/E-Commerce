@extends('layout.default')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link href="{{ asset('cdn/css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>
    <x-sweetalert />
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="bg-dark">
                    <h4 class="text-center mb-0 text-white">Student Registration</h4>
                </div>
                <br><br>
                <form action="{{ isset($data) ? route('students.update', $data->id) : route('students.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-1">
                        <img src="{{ isset($data) ? asset('webimg/' . $data->image) : '' }}"
                            alt="{{ isset($data) ? $data->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Student Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" id="image">
                        <span class="text-danger">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </span>

                        </span>
                    </div>
                    <!-- Name Field -->
                    <div class="mb-1">
                        <label class="form-label">Student Name <span class="text-danger">*</span></label>
                        <input type="text" class="@error('name') is-invalid @enderror form-control"
                            value="{{ isset($data) ? $data->name : '' }}" name="name" id="name"
                            placeholder="Enter Full Name">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="@error('email') is-invalid @enderror form-control"
                            value="{{ isset($data) ? $data->email : '' }}" name="email" id="email"
                            placeholder="Enter Email Address">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" class="@error('city') is-invalid @enderror form-control"
                            value="{{ isset($data) ? $data->city : '' }}" name="city" id="city"
                            placeholder="Enter city">
                        @error('city')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Hobbies Field -->
                    <div class="mb-3">
                        <label class="form-label">Hobbies <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobbies" name="hobbies[]"
                                value="Reading"
                                {{ isset($data) ? (in_array('Reading', explode(',', $data->hobbies)) ? 'checked' : '') : '' }}>
                            <label class="form-check-label">Reading</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobbies1" name="hobbies[]"
                                value="Traveling"
                                {{ isset($data) ? (in_array('Traveling', explode(',', $data->hobbies)) ? 'checked' : '') : '' }}>
                            <label class="form-check-label">Traveling</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobbies2" name="hobbies[]"
                                value="Gaming"
                                {{ isset($data) ? (in_array('Gaming', explode(',', $data->hobbies)) ? 'checked' : '') : '' }}>
                            <label class="form-check-label">Gaming</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hobbies3" name="hobbies[]"
                                value="Music"
                                {{ isset($data) ? (in_array('Music', explode(',', $data->hobbies)) ? 'checked' : '') : '' }}>
                            <label class="form-check-label">Music</label>
                        </div>
                        <span class="text-danger">
                            @error('hobbies')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <!-- Age Field -->
                    <div class="mb-3">
                        <label class="form-label">Age <span class="text-danger">*</span></label>
                        <input type="number" class="@error('age') is-invalid @enderror form-control"
                            value="{{ isset($data) ? $data->age : '' }}" name="age" id="age"
                            placeholder="Enter Age">
                        @error('age')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Gender Field (Radio Buttons) -->
                    <div class="mb-3">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <div>
                            <input type="radio" name="gender" value="Male" id="male"
                                {{ isset($data) ? ($data->gender === 'Male' ? 'checked' : '') : '' }}>
                            <label for="male">Male</label>

                            <input type="radio" name="gender" value="Female" id="female" class="ms-3"
                                {{ isset($data) ? ($data->gender === 'Female' ? 'checked' : '') : '' }}>
                            <label for="female">Female</label>

                            <input type="radio" name="gender" value="Other" id="other" class="ms-3"
                                {{ isset($data) ? ($data->gender === 'Other' ? 'checked' : '') : '' }}>
                            <label for="other">Other</label>
                        </div>
                        <span class="text-danger">
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">stander <span class="text-danger">*</span></label>
                        <select class="form-control" name="stander" id="stander">
                            <option value="">Select stander</option>
                            <option value="class one"
                                {{ isset($data) ? ($data->stander === 'class one' ? 'selected' : '') : '' }}>class one
                            </option>
                            <option value="class two"
                                {{ isset($data) ? ($data->stander === 'class two' ? 'selected' : '') : '' }}>class two
                            </option>
                            <option value="class three"
                                {{ isset($data) ? ($data->stander === 'class three' ? 'selected' : '') : '' }}>class
                                three</option>
                            <option value="class foure"
                                {{ isset($data) ? ($data->stander === 'class foure' ? 'selected' : '') : '' }}>class
                                four
                            </option>
                            <option value="class five"
                                {{ isset($data) ? ($data->stander === 'class five' ? 'selected' : '') : '' }}>class
                                five
                            </option>
                            <option value="class six"
                                {{ isset($data) ? ($data->stander === 'class six' ? 'selected' : '') : '' }}>class six
                            </option>
                            <option value="class seven"
                                {{ isset($data) ? ($data->stander === 'class seven' ? 'selected' : '') : '' }}>class
                                seven</option>
                            <option value="class eight"
                                {{ isset($data) ? ($data->stander === 'class eight' ? 'selected' : '') : '' }}>class
                                eight</option>
                            <option value="class nine"
                                {{ isset($data) ? ($data->stander === 'class nine' ? 'selected' : '') : '' }}>class
                                nine
                            </option>
                            <option value="class ten"
                                {{ isset($data) ? ($data->stander === 'class ten' ? 'selected' : '') : '' }}>class ten
                            </option>
                            <option value="class eleven"
                                {{ isset($data) ? ($data->stander === 'class eleven' ? 'selected' : '') : '' }}>class
                                eleven</option>
                            <option value="class twelve"
                                {{ isset($data) ? ($data->stander === 'class twelve' ? 'selected' : '') : '' }}>class
                                twelve</option>
                        </select>
                        <span class="text-danger">
                            @error('stander')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <button type="submit"
                        class="btn btn-primary btn-sm w-50 mt-2">{{ isset($data) ? 'Update' : 'Create' }}</button>
                        <a href="{{ route('students.details') }}" class="btn btn-primary btn-sm mt-2 ">Cansal
                        </a>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection
