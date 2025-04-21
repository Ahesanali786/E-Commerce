@extends('layout.website.app')

@section('title', 'products-details')

@section('website')

<body class="gradient-bg">
    <main class="pt-90">
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item">
                                        <img loading="lazy" class="h-auto"
                                            src="{{ asset('Product_image/' . $productDtails->image) }}" width="674"
                                            height="674" alt="{{ $productDtails->name }}" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item"><img loading="lazy"
                                            class="h-auto" src="{{ asset('Product_image/' . $productDtails->image) }}"
                                            width="104" height="104" alt="{{ $productDtails->name }}" /></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                        </div><!-- /.breadcrumb -->

                        <div
                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                            <a href="{{ URL::to('products/details/' . $previous) }}"
                                class="text-uppercase fw-medium"><svg width="10" height="10" viewBox="0 0 25 25"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_md" />
                                </svg><span class="menu-link menu-link_us-s">Prev</span></a>
                            <a href="{{ URL::to('products/details/' . $next) }}" class="text-uppercase fw-medium"><span
                                    class="menu-link menu-link_us-s">Next</span><svg width="10" height="10"
                                    viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_md" />
                                </svg></a>
                        </div><!-- /.shop-acs -->
                    </div>
                    <h1 class="product-single__name">{{ $productDtails->name }}</h1>
                    <div class="product-single__rating">
                        <div class="reviews-group d-flex">
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                        </div>
                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                    </div>
                    <div class="product-single__price">
                        <span class="current-price">$</span>
                        <span class="current-price">{{ $productDtails->price }}</span>
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{ $productDtails->description }}</p>
                        {{-- <p>{{ $variants->attribute()->variant_name }} -- {{ $variants->variant_value }}</p> --}}


                        {{-- {{ dd($colorValues) }} --}}
                        @if (isset($colorValues) && count($colorValues) > 0)
                        <div class="variant-options">
                            <label class="form-label">Select Colour <span class="text-danger">*</span></label>
                            <div class="size-buttons">
                                @foreach ($colorValues as $colorValue)
                                <button type="button" class="btn btn-outline-secondary colour-btn"
                                    data-value="{{ $colorValue->id }}" value="{{ $colorValue->variant_value }}">
                                    {{ $colorValue->variant_value }}
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="no-variants">
                            <p>No variants available.</p>
                        </div>
                        @endif
                        @if (isset($sizeValue) && count($sizeValue) > 0)
                        <div class="variant-options">
                            <label class="form-label">Select Size <span class="text-danger">*</span></label>
                            <div class="size-buttons">
                                @foreach ($sizeValue as $sizeValues)
                                <button type="button" class="btn btn-outline-secondary variant-btn"
                                    data-value="{{ $sizeValues->id }}" value="{{ $sizeValues->variant_value }}">
                                    {{ $sizeValues->variant_value }}
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="no-variants">
                            <p>No variants available.</p>
                        </div>
                        @endif
                    </div>
                    <form action="{{ route('add.cart') }}" method="post">
                        @csrf
                        <input type="hidden" name="selected_colour[]" id="selected_colour">
                        <input type="hidden" name="selected_size[]" id="selected_size">
                        <div class="product-single__addtocart">
                            <div class="qty-control position-relative">
                                <input type="number" name="qty" value="1" min="1"
                                    class="qty-control__number text-center">
                                <div class="qty-control__reduce">-</div>
                                <div class="qty-control__increase">+</div>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $productDtails->id }}">
                            <button type="submit" class="btn btn-primary btn-addtocart">Add to
                                Cart</button>
                        </div>
                    </form>
                    <div class="product-single__addtolinks">
                        <a href="#" class="menu-link menu-link_us-s add-to-wishlist"><svg width="16" height="16"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg><span>Add to Wishlist</span></a>
                        <share-button class="share-button">
                            <button
                                class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_sharing" />
                                </svg>
                                <span>Share</span>
                            </button>
                            <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                <div id="Article-share-template__main"
                                    class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                                    <div class="field grow mr-4">
                                        <label class="field__label sr-only" for="url">Link</label>
                                        <input type="text" class="field__input w-full" id="url"
                                            value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                            placeholder="Link" onclick="this.select();" readonly="">
                                    </div>
                                    <button class="share-button__copy no-js-hidden">
                                        <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13"
                                            fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            focusable="false" viewBox="0 0 11 13">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <span class="sr-only">Copy link</span>
                                    </button>
                                </div>
                            </details>
                        </share-button>
                        <script src="js/details-disclosure.html" defer="defer"></script>
                        <script src="js/share.html" defer="defer"></script>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>SUB-CATEGORIES:</label>
                            <span>{{ $productDtails->subCategory->name }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Categories:</label>
                            <span>{{ $productDtails->subCategory->Category->name }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Tags:</label>
                            <span>biker, black, bomber, leather</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                            href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                            aria-selected="false">Additional Information</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                            href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews
                            (2)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                        aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            <h3 class="block-title mb-4">{{ $productDtails->description }}</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="block-title">Why choose product?</h3>
                                        <ul class="list text-list">
                                            <li>Creat by cotton fibric with soft and smooth</li>
                                            <li>Simple, Configurable (e.g. size, color, etc.), bundled</li>
                                            <li>Downloadable/Digital Products, Virtual Products</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 class="block-title">Sample Number List</h3>
                                        <ol class="list text-list">
                                            <li>Create Store-specific attrittbutes on the fly</li>
                                            <li>Simple, Configurable (e.g. size, color, etc.), bundled</li>
                                            <li>Downloadable/Digital Products, Virtual Products</li>
                                        </ol>
                                    </div>
                                </div>
                                <h3 class="block-title mb-0">Lining</h3>
                                <p class="content">100% Polyester, Main: 100% Polyester.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                        aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__addtional-info">
                            <div class="item">
                                <label class="h6">Weight</label>
                                <span>1.25 kg</span>
                            </div>
                            <div class="item">
                                <label class="h6">Dimensions</label>
                                <span>90 x 60 x 90 cm</span>
                            </div>
                            <div class="item">
                                <label class="h6">Size</label>
                                @foreach ($sizeValue as $sizeValues)
                                <span>{{ $sizeValues->variant_value }},</span>
                                @endforeach
                            </div>
                            <div class="item">
                                <label class="h6">Color</label>
                                @foreach ($colorValues as $colorValue)
                                <span>{{ $colorValue->variant_value }},</span>
                                @endforeach
                            </div>
                            <div class="item">
                                <label class="h6">Storage</label>
                                <span>Relaxed fit shirt-style dress with a rugged</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <h2 class="product-single__reviews-title">Reviews</h2>
                        <div class="product-single__reviews-list">
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Janice Miller</h6>
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit
                                            quo minus id quod
                                            maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Benjam Porter</h6>
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit
                                            quo minus id quod
                                            maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__review-form">
                            <form name="customer-review-form">
                                <h5>Be the first to review “Message Cotton T-Shirt”</h5>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <div class="select-star-rating">
                                    <label>Your rating *</label>
                                    <span class="star-rating">
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                    </span>
                                    <input type="hidden" id="form-input-rating" value="" />
                                </div>
                                <div class="mb-4">
                                    <textarea id="form-input-review" class="form-control form-control_gray"
                                        placeholder="Your Review" cols="30" rows="8"></textarea>
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-name" class="form-label">Name *</label>
                                    <input id="form-input-name" class="form-control form-control-md form-control_gray">
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-email" class="form-label">Email address *</label>
                                    <input id="form-input-email" class="form-control form-control-md form-control_gray">
                                </div>
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
                    </div>
                </div>
            </div>
        </section>
        <section class="products-carousel container">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
                    <div class="swiper-wrapper">
                        @foreach ($products as $product)
                        {{-- {{ dd($product) }} --}}
                        <div class="swiper-slide product-card">
                            <div class="pc__img-wrapper">
                                <a href="{{ url('products/details/' . $product->id) }}">
                                    <img loading="lazy" src="{{ asset('Product_image/' . $product->image) }}"
                                        width="330" height="400" alt="{{ $product->name }}" class="pc__img">
                                </a>
                            </div>

                            <div class="pc__info position-relative">
                                <p class="pc__category">{{ $product->subCategory->Category->name }}</p>
                                <h6 class="pc__title"><a href="details.html">{{ $product->name }}</a></h6>
                                <div class="product-card__price d-flex">
                                    <span class="money price">${{ $product->price }}</span>
                                </div>

                                <button
                                    class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                    title="Add To Wishlist">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_heart" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->
                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>

    {{-- <script src="{{ asset('website/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('website/js/theme.js') }}"></script> --}}
    {{-- <script>
        document.querySelectorAll('.variant-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    document.querySelectorAll('.variant-btn').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    // Add active class to clicked button
                    this.classList.add('active');
                });
            });
    </script>
    <script>
        document.querySelectorAll('.colour-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    document.querySelectorAll('.colour-btn').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    // Add active class to clicked button
                    this.classList.add('active');
                });
            });
    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
                // Get all qty-control blocks if there are multiple
                document.querySelectorAll('.qty-control').forEach(function (control) {
                    const input = control.querySelector('.qty-control__number');
                    const increaseBtn = control.querySelector('.qty-control__increase');
                    const decreaseBtn = control.querySelector('.qty-control__reduce');

                    increaseBtn.addEventListener('click', function () {
                        let current = parseInt(input.value) || 1;
                        input.value = current + 1;
                    });

                    decreaseBtn.addEventListener('click', function () {
                        let current = parseInt(input.value) || 1;
                        if (current > 1) {
                            input.value = current - 1;
                        }
                    });
                });
            });
    </script> --}}
    <script>
        document.querySelectorAll('.colour-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                // Remove active from all
                document.querySelectorAll('.colour-btn').forEach(b => b.classList.remove('active'));

                // Add active to selected
                this.classList.add('active');

                // Set hidden input value
                document.getElementById('selected_colour').value = this.getAttribute('value');
            });
        });

        document.querySelectorAll('.variant-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.variant-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('selected_size').value = this.getAttribute('value');
            });
        });
    </script>
</body>

@endsection
