@extends('layout.website.app')
<link rel="stylesheet" href="{{ asset('website/css/myorder.css') }}">
@section('title', 'My Orders')

@section('website')
<main class="pt-90">
    <div class="mb-md-1 pb-md-3"></div>
    <section class="product-single container">

        @if(count($showMyOrders) > 0)
        @foreach ($showMyOrders as $showMyOrder)
        <div class="order-card">
            <div class="product-info">
                <a href="{{  route('prodcuts.details', ['product_id' => Crypt::encrypt($showMyOrder->product->id)]) }}">
                    <img src="{{ asset('Product_image/' . $showMyOrder->product->image) }}" alt="Product Image"
                        class="product-img">
                </a>
                <div class="product-details">
                    <div class="product-title">{{ $showMyOrder->product->name }}</div>
                    <div class="price">₹{{ $showMyOrder->product->price }}</div>
                </div>
            </div>
            <div class="status">
                <div class="delivered">● Delivered on {{ date('M-d', strtotime($showMyOrder->created_at)) }}</div>
                <div>Your item has been delivered</div>

                @if ($showMyOrder->user_review)
                <div class="user-review d-flex gap-1">
                    <div style="display: flex; gap: 2px; font-size: 16px; color: #FFD700;">
                        @for ($i = 0; $i < $showMyOrder->user_review->rating; $i++)
                            <span>★</span>
                            @endfor
                            @for ($i = $showMyOrder->user_review->rating; $i < 5; $i++) <span style="color: #ccc;">
                                ☆</span>
                                @endfor
                    </div>
                </div>
                @else
                @php
                $encodedId = Crypt::encryptString($showMyOrder->id);
                @endphp
                <a href="{{ route('product.review', ['order_id' => $encodedId]) }}" class="review-link">★ Rate & Review
                    Product</a>
                @endif
            </div>
        </div>
        @endforeach
        @else
        <div class="order-card text-center" style="padding: 40px; background-color: #f9f9f9; border: 1px solid #ddd;">
            <h4>No Orders Found</h4>
            <p>It looks like you haven’t ordered anything yet.</p>
            <a href="{{ route('shop.prodcuts') }}" class="btn btn-primary mt-3">Start Shopping</a>
        </div>
        @endif

    </section>
</main>
@endsection
