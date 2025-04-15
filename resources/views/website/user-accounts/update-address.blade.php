@extends('layout.website.app')

@section('title', 'user accounts details')

@section('website')
<style>
    .error {
        color: red;
        font-size: 18px;
        margin-bottom: 5px;
    }
</style>
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Add New Address</h2>
        <div class="row">
            @include('layout.website.user-dashboard.user-account')
            <div class="col-lg-9">
                <div class="page-content my-account__edit">
                    <div class="my-account__edit-form">
                        <form name="account_edit_form" action="{{ route('update.address',$editAddress->id) }}" method="POST" class="needs-validation">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $editAddress->name }}">
                                        <label for="name">Full Name *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="error" id="nameError"></div>
                                    <span class="text-danger">@error('name') <h5 style="color: rgb(237, 14, 14)">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </h5>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="phone" value="{{ $editAddress->phone_no }}">
                                        <label for="phone">Phone Number *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="error" id="phoneError"></div>
                                    <h5 style="color: red">
                                        <span class="text-danger">@error('phone') <h5 style="color: red">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </h5> @enderror</span>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="zip" value="{{ $editAddress->pincode }}">
                                        <label for="zip">Pincode *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="error" id="pincodeError"></div>
                                    <h5 style="color: red">
                                        <span class="text-danger">@error('zip') <h5 style="color: red">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </h5> @enderror</span>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" name="state" value="{{ $editAddress->state }}">
                                        <label for="state">State *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="error" id="stateError"></div>
                                    <h5 style="color: red">
                                        <span class="text-danger">@error('state') <h5 style="color: red">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </h5> @enderror</span>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="city" value="{{ $editAddress->city }}">
                                        <label for="city">Town / City *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="error" id="cityError"></div>
                                    <h5 style="color: red">
                                        <span class="text-danger">@error('city') <h5 style="color: red">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </h5> @enderror</span>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="address" value="{{ $editAddress->house_no }}">
                                        <label for="address">House no, Building Name *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="error" id="addressError"></div>
                                    <h5 style="color: red">
                                        <span class="text-danger">@error('address')
                                            <h5 style="color: red">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </h5> @enderror
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="locality" value="{{ $editAddress->area }}">
                                        <label for="locality">Road Name, Area, Colony *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="error" id="localityError"></div>
                                    <h5 style="color: red">
                                        <span class="text-danger">
                                            @error('locality')
                                            <h5 style="color: red">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </h5>
                                            @enderror
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="landmark" value="{{ $editAddress->landmark }}">
                                        <label for="landmark">Landmark *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="error" id="landmarkError"></div>
                                    <span class="text-danger">
                                        @error('landmark')
                                        <h5 style="color: red">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </h5>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <button type="submit" class="btn btn-primary" onclick="return orderFormValidation()" >Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="{{ asset('website/js/orderformvalidation.js') }}"></script>
@endsection
