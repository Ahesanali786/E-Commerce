@extends('layout.website.app')

@section('title','user address details')

@section('website')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Addresses</h2>
        <div class="row">
            @include('layout.website.user-dashboard.user-account')
            <div class="col-lg-9">
                <div class="page-content my-account__address">
                    <div class="row">
                        <div class="col-6">
                            <p class="notice">The following addresses will be used on the checkout page by default.</p>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('add.new.address') }}" class="btn btn-sm btn-info">Add New</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="address-container">
                            <div class="address-header">
                                <span>{{ $addresses->count() }}</span> YOUR ADDRESS
                            </div>
                            <span class="text-danger">@error('addrss') <h5 style="color: red">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </h5>
                                @enderror
                            </span>
                            @foreach ($addresses as $index => $address)

                            <div class="address-block" style="{{ $index > 1 ? 'display:none;' : '' }}"
                                data-index="{{ $index }}">
                                <div class="address-details">
                                    <div class="my-account__address-item__title">
                                        <a href="{{ route('edit.address',$address->id) }}"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('delete.address',$address->id) }}"><i class="fa fa-trash"></i></a>
                                      </div>
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
                </div>
            </div>
        </div>
    </section>
</main>
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
@endsection