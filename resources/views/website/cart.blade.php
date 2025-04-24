@extends('layout.website.app')

@section('title', 'Cart Page')

@section('website')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Cart</h2>
        <div class="checkout-steps">
            <a class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
            </a>
            <a class="checkout-steps__item">
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
        <div class="mt-3">
            <input type="hidden" name="error">
            @error('error')
            <div class="custom-error-box">
                <span class="custom-error-icon">⚠️</span>
                <span class="custom-error-text">{{ $message }}</span>
            </div>
            @enderror
            <div id="cart-message" style="display:none;" class="alert alert-success"></div>
        </div>
        <div class="shopping-cart">
            <div class="cart-table__wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartDetails as $cart)
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="{{ asset('Product_image/' . $cart->product->image) }}"
                                        width="120" height="120" alt="hello" />
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>{{ $cart->product->name }}</h4>
                                    <ul class="shopping-cart__product-item__options">
                                        <li>Categories -:{{ $cart->product->subCategory->Category->name }}</li>
                                        <li>SubCategories -:{{ $cart->product->subCategory->name }}</li>
                                        <?php
                                                $productsVariants = json_decode($cart->products_variants,true);
                                            ?>
                                        @foreach ($productsVariants as $varient)
                                        <li>Colour -:{{ $varient['product_size'] }}</li>
                                        <li>Size -:{{ $varient['product_colour'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">{{ $cart->product->price }}</span>
                            </td>
                            <td>
                                <form action="{{ route('update.cart', $cart->id) }}" class="position-relative bg-body"
                                    method="POST">
                                    @csrf
                                    <div class="qty-control position-relative">
                                        <input type="number" name="qty" value="{{ $cart->qty }}" min="1"
                                            class="qty-control__number text-center">
                                        <div class="qty-control__reduce">-</div>
                                        <div class="qty-control__increase">+</div>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $cart->id }}">
                                    <div>
                                        <button type="submit" class="btn btn-3">Update now</button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">$
                                    {{ $cart->product->price * $cart->qty }}</span>
                            </td>
                            <td>
                                <a href="javascript:void(0)" id="delete-user"
                                    data-url="{{ route('remove.cart', $cart->id) }}" class="remove-cart">
                                    {{-- <a href="{{ route('remove.cart', $cart->id) }}" class="remove-cart"> --}}
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                            <path
                                                d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                        </svg>
                                    </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="cart-table-footer">
                    <form action="{{ route('cart.update.qty') }}" method="POST">
                        @csrf
                        @foreach ($cartDetails as $cart)
                        <input type="hidden" name="ids[]" value="{{ $cart->id }}">
                        @endforeach
                        <button type="submit" class="btn btn-success">Update All Items</button>
                    </form>
                </div> --}}
                <div class="cart-table-footer">
                    @if ($cartDetails->count() > 0)
                    <form action="{{ route('cart.update.qty') }}" method="POST">
                        @csrf
                        @foreach ($cartDetails as $cart)
                        <input type="hidden" name="ids[]" value="{{ $cart->id }}">
                        @endforeach
                        <button type="submit" class="btn btn-success">Update All Items</button>
                    </form>
                    @else
                    <a href="{{ route('shop.prodcuts') }}" class="btn btn-primary">Shopping Now</a>
                    @endif
                </div>

            </div>
            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3>Cart Totals</h3>
                        <table class="cart-totals">
                            <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>@php
                                        $total = 0;
                                        foreach ($cartDetails as $cart) {
                                        $total += $cart->product->price * $cart->qty;
                                        }
                                        @endphp
                                        ${{ $total }}
                                    </td>
                                </tr>

                                {{-- <tr>
                                    <th>VAT</th>
                                    <td>$19</td>
                                </tr> --}}
                                <tr>
                                    <th>Total</th>
                                    <td>${{ $total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <a href="{{ route('order.products') }}" class="btn btn-primary btn-checkout">PROCEED TO
                                CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.remove-cart', function () {
            var userURL = $(this).data('url');
            var trObj = $(this).closest("tr");

            if (confirm("Are you sure you want to remove this item?")) {
                $.ajax({
                    url: userURL,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        trObj.remove();
                        toastr.success(data.success);
                         $("#cart-message").text(data.success).fadeIn().delay(2000).fadeOut();
                        updateCartTotal();
                        updateCartFooter();
                    }
                });
            }
        });

        function updateCartTotal() {
            var newTotal = 0;
            $(".shopping-cart__subtotal").each(function () {
                var price = parseFloat($(this).text().replace("$", ""));
                newTotal += price;
            });
            $(".cart-totals td:contains('$')").first().text("$" + newTotal.toFixed(2));
            $(".cart-totals td:contains('$')").last().text("$" + newTotal.toFixed(2));
        }

        function updateCartFooter() {
            if ($(".shopping-cart__subtotal").length === 0) {
                $(".cart-table-footer").html(`
                    <a href="{{ route('shop.prodcuts') }}" class="btn btn-primary">Shopping Now</a>
                `);
            }
        }
    });
</script>

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
@endsection
