<div class="section-menu-left">
    <div class="box-logo">
        <a href="index.html" id="site-logo-inner">
            {{-- <img class="" id="logo_header" alt="" src="{{ asset('website-admin/images/logo/logo.png') }}"
                data-light="{{ asset('website-admin/images/logo/logo.png') }}"
                data-dark="{{ asset('website-admin/images/logo/logo.png') }}"> --}}
            <img class="" alt="" src="{{ asset('website-admin/images/logo/logo.png') }}"
                data-light="{{ asset('website-admin/images/logo/logo.png') }}"
                data-dark="{{ asset('website-admin/images/logo/logo.png') }}"
                data-retina="{{ asset('website-admin/images/logo/logo.png') }}">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            <a href="{{ route('home.page') }}">
                <div class="center-heading">Main Home</div>
            </a>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{ route('user.dashboard') }}" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Dashboard</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="center-item">
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{ route('user.dashboard.orders.list') }}" class="">
                        <div class="icon"><i class="icon-file-plus"></i></div>
                        <div class="text">My-Order</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('user.accounts.address') }}" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Addresses</div>
                    </a>
                </li>

                {{-- <li class="menu-item">
                    <a href="users.html" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">Account Details</div>
                    </a>
                </li> --}}

                <li class="menu-item">
                    <a href="{{ route('user.accounts') }}" class="">
                        <div class="icon"><i class="icon-settings"></i></div>
                        <div class="text">Settings</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
