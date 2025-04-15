@extends('layout.website.app')

@section('title', 'order page')

@section('website')
<style>
    .error {
        color: red;
        font-size: 14px;
        margin-bottom: 5px;
    }
</style>
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Shipping and Checkout</h2>
        <div class="checkout-steps">
            <a class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
            </a>
            <a class="checkout-steps__item active">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Shipping and Checkout</span>
                    <em>Checkout Your Items List</em>
                </span>
            </a>
            <a class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Confirmation</span>
                    <em>Review And Submit Your Order</em>
                </span>
            </a>
        </div>
        <form name="checkout-form" action="{{ route('place.order') }}" method="POST" id="myform">
            @csrf
            <div class="checkout-form">
                <div class="billing-info__wrapper">
                    <div class="row">
                        <div class="col-6">
                            <h4>SHIPPING DETAILS</h4>
                        </div>
                        <div class="col-6">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="address-container">
                            <div class="address-header">
                                <span>{{ $addresses->count() }}</span> DELIVERY ADDRESS
                            </div>
                            <span class="text-danger">@error('address_id') <h5 style="color: red">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </h5>
                                @enderror
                            </span>
                            @foreach ($addresses as $index => $address)
                            <div class="address-block" style="{{ $index > 1 ? 'display:none;' : '' }}"
                                data-index="{{ $index }}">
                                <input class="address-radio" type="radio" name="address_id" value="{{ $address->id }}">
                                <div class="address-details">
                                    <div>
                                        <strong>{{ $address->name }}</strong>
                                        <span class="label">WORK</span>
                                        <span class="phone">{{ $address->phone_no }}</span>
                                    </div>
                                    <div>
                                        {{ $address->landmark }}, {{ $address->house_no }}, {{ $address->area }},
                                        {{ $address->city }}, {{ $address->state }} -
                                        <strong>{{ $address->pincode }}</strong>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @if(count($addresses) > 2)
                            <div style="text-align:center; margin-top: 1rem;">
                                <button id="showMoreBtn" onclick="toggleAddresses()" type="button">Show More</button>
                            </div>
                            @endif
                        </div>

                    </div>
                    <div class="row mt-5" id="form">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success add-more" onclick="openForm()">
                                <i class="fa fa-plus"></i>
                                <h4><strong> Add More </strong></h4>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="checkout__totals-wrapper">
                    <div class="sticky-content">
                        <div class="checkout__totals">
                            <h3>Your Order</h3>
                            <table class="checkout-cart-items">
                                <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th align="center">quantity</th>
                                        <th align="right">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetails as $orderDetail)
                                    <tr>
                                        <td>{{ $orderDetail->product->name }}</td>
                                        <td align="center">{{ $orderDetail->qty }}</td>
                                        <td align="right">${{ $orderDetail->product->price * $orderDetail->qty }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="checkout-totals">
                                <tbody>
                                    <tr>
                                        <th>SUBTOTAL</th>
                                        <td align="right">@php
                                            $total = 0;
                                            foreach ($orderDetails as $orderDetail) {
                                            $total += $orderDetail->product->price * $orderDetail->qty;
                                            }
                                            @endphp
                                            ${{ $total }}</td>
                                    </tr>
                                    <tr>
                                        <th>SHIPPING</th>
                                        <td align="right">Free shipping</td>
                                    </tr>
                                    <tr>
                                        <th>VAT</th>
                                        <td align="right">$19</td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL</th>
                                        <td align="right">
                                            @php
                                            $grandTotal = $total + 19;
                                            @endphp

                                            ${{ $grandTotal }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout__payment-methods">
                            <div class="container mb-3">
                                <input type="hidden" name="checkout_payment_method">
                                <span class="text-danger">
                                    @error('checkout_payment_method')
                                    <h5 style="color: red">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </h5>
                                    @enderror
                                </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_1"
                                    value="Direct bank transfer">
                                <label class="form-check-label" for="checkout_payment_method_1">
                                    Direct bank transfer
                                    <p class="option-detail">
                                        Make your payment directly into our bank account. Please use your Order ID as
                                        the payment
                                        reference.Your order will not be shipped until the funds have cleared in our
                                        account.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_2"
                                    value="Check payments">
                                <label class="form-check-label" for="checkout_payment_method_2">
                                    Check payments
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida
                                        nec dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra
                                        nunc, ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_3"
                                    value="Cash on delivery">
                                <label class="form-check-label" for="checkout_payment_method_3">
                                    Cash on delivery
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida
                                        nec dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra
                                        nunc, ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_4" value="Paypal">
                                <label class="form-check-label" for="checkout_payment_method_4">
                                    Paypal
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida
                                        nec dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra
                                        nunc, ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="policy-text">
                                Your personal data will be used to process your order, support your experience
                                throughout this
                                website, and for other purposes described in our <a href="terms.html"
                                    target="_blank">privacy
                                    policy</a>.
                            </div>
                        </div>
                        {{-- {{ dd($orderDetails) }} --}}
                        <input type="hidden" name="orderDetails[]" value="{{ $orderDetails }}">
                        <button type="submit" class="btn btn-primary btn-checkout"
                            onclick="return orderFormValidation()">PLACE
                            ORDER</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>
{{-- <script src="{{ asset('website/js/orderformvalidation.js') }}"></script> --}}
<script>
    function toggleAddresses() {
        const blocks = document.querySelectorAll('.address-block');
        const btn = document.getElementById('showMoreBtn');
        let expanded = btn.getAttribute('data-expanded') === 'true';

        blocks.forEach((block, index) => {
            if (index > 1) {
                block.style.display = expanded ? 'none' : 'flex';
            }
        });

        btn.textContent = expanded ? 'Show More' : 'Show Less';
        btn.setAttribute('data-expanded', !expanded);
    }
</script>

<script>
    function openForm(){
        document.getElementById("form").innerHTML = ` <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                <label for="name">Full Name *</label>
                                <span class="text-danger"></span>
                            </div>
                            <div class="error" id="nameError"></div>
                            <span class="text-danger">@error('name') <h5 style="color: rgb(0, 255, 221)">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </h5>
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="phone">
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
                                <input type="text" class="form-control" name="zip">
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
                                <input type="text" class="form-control" name="state">
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
                                <input type="text" class="form-control" name="city">
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
                                <input type="text" class="form-control" name="address">
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
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="locality">
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
                                <input type="text" class="form-control" name="landmark">
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
                        </div>`;
    }
</script>
@endsection
