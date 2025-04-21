@extends('layout.user-dashboard.main')

@section('title', 'User Address Details')

@section('containt')
<main class="main-content-inner">
    <section class="my-account container">
        <h2 class="page-title" style="font-size: 50px">Your Saved Addresses</h2>

        <div class="row" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="col-md-6">
                <p class="notice">These addresses will be used by default at checkout.</p>
            </div>
            <div class="col-md-6 mb-6" style="text-align: right;">
                <a href="{{ route('add.new.address') }}" class="btn-custom">+ Add New Address</a>
            </div>
        </div>

        <div class="address-container mt-5">
            <div class="address-header" style="font-size: 20px">{{ $addresses->count() }} Address{{ $addresses->count() > 1 ? 'es' : '' }}</div>

            @foreach ($addresses as $index => $address)
            <div class="address-block" style="{{ $index > 1 ? 'display:none;' : '' }}" data-index="{{ $index }}">
                <div class="address-details">
                    <strong>{{ $address->name }}</strong>
                    <span class="badge-label">Work</span>
                    <div class="text-muted">{{ $address->phone_no }}</div>

                    <div>
                        {{ $address->landmark }}, {{ $address->house_no }}, {{ $address->area }},
                        {{ $address->city }}, {{ $address->state }} -
                        <strong>{{ $address->pincode }}</strong>
                    </div>

                    <div class="address-actions">
                        <a href="{{ route('edit.address', $address->id) }}" class="btn-outline">
                            ✏️ Edit
                        </a>
                        <a href="{{ route('delete.address', $address->id) }}"
                           onclick="return confirm('Are you sure you want to delete this address?')"
                           class="btn-outline">
                            🗑️ Delete
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            @if(count($addresses) > 2)
            <div style="text-align:center;">
                <button id="showMoreBtn" onclick="toggleAddresses()">Show More</button>
            </div>
            @endif
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
                block.style.display = expanded ? 'none' : 'block';
            }
        });

        btn.textContent = expanded ? 'Show More' : 'Show Less';
        btn.setAttribute('data-expanded', !expanded);
    }
</script>
@endsection
