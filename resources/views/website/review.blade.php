@extends('layout.website.app')
@section('title','Products Reviews')
<link rel="stylesheet" href="{{ asset('website/css/myorder.css') }}">
@section('website')
<main class="pt-90">
    <div class="mb-md-1 pb-md-3"></div>
    <section class="product-single container">
        <div class="product-single__review-form">
            <form name="customer-review-form" action="{{ route('store.product.review') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $reviewProduct->product->id }}">
                <input type="hidden" name="orderDetails_id" value="{{ $reviewProduct->id }}">
                <div class="review-header">
                    <h2>Ratings & Reviews</h2>
                    <div class="product-brief">
                        {{-- str::limit use to if product name greter then 10 charectore then show ... --}}
                        <div class="product-name">{{ Str::limit($reviewProduct->product->name, 10) }}</div>
                        <a href="{{  route('prodcuts.details', ['product_id' => Crypt::encrypt($reviewProduct->product->id)]) }}">
                        <img src="{{ asset('Product_image/' . $reviewProduct->product->image) }}"
                            alt="{{ $reviewProduct->product->name }}"></a>
                    </div>
                </div>
                <h5>Be the first to review “Message {{ $reviewProduct->product->name }}”</h5>
                <p>Your email address will not be published. Required fields are marked *</p>
                <div class="select-star-rating">
                    <label>Your rating *</label>
                    <span class="star-rating">
                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                        </svg>
                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                        </svg>
                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                        </svg>
                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                        </svg>
                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                        </svg>
                    </span>
                    <input type="hidden" id="form-input-rating" value="" name="product_rating" />
                    <span class="text-danger">@error('product_rating') <h5 style="color: red">
                        <strong>
                            {{ $message }}
                        </strong>
                    </h5>
                    @enderror
                </span>
                </div>
                <div class="mb-4">
                    <textarea id="form-input-review" class="form-control form-control_gray" placeholder="Your Review"
                        cols="30" rows="8" name="review"></textarea>
                        <span class="text-danger">@error('review') <h5 style="color: red">
                            <strong>
                                {{ $message }}
                            </strong>
                        </h5>
                        @enderror
                    </span>
                </div>
                <div class="form-label-fixed mb-4">
                    <label for="form-input-name" class="form-label">Name *</label>
                    <input id="form-input-name" class="form-control form-control-md form-control_gray" name="name">
                    <span class="text-danger">@error('name') <h5 style="color: red">
                        <strong>
                            {{ $message }}
                        </strong>
                    </h5>
                    @enderror
                </span>
                </div>
                <div class="form-label-fixed mb-4">
                    <label for="form    -input-email" class="form-label">Email address *</label>
                    <input id="form-input-email" class="form-control form-control-md form-control_gray" name="email">
                </div>
                <span class="text-danger">@error('email') <h5 style="color: red">
                    <strong>
                        {{ $message }}
                    </strong>
                </h5>
                @enderror
            </span>
                <div class="form-check mb-4">
                    <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                        id="remember_checkbox">
                    <label class="form-check-label" for="remember_checkbox">
                        Save my name, email, and website in this browser for the next time I comment.
                    </label>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection
