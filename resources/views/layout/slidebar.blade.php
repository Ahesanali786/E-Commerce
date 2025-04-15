<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link">
            <!--begin::Brand Image--> <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="{{ route('home.page') }}" class="nav-link"> <i
                            class="fa-solid fa-house-chimney"></i>
                        <p>website</p>
                    </a> </li>
                {{-- <li class="nav-item"> <a href="{{ route('students.details') }}" class="nav-link"> <i
                            class="fa-solid fa-house-chimney"></i>
                        <p>Home</p>
                    </a> </li>
                <li class="nav-item"> <a href="{{ route('students.form') }}" class="nav-link"> <i
                            class="fa-solid fa-user-plus"></i>
                        <p>Add-Students</p>
                    </a> </li> --}}
                <li class="nav-header">Categories</li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Category
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('add.category') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add-Category</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('all.category') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Category List</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-header">SubCategories</li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            SubCategory
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('add.sub.category') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add-SubCategory</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('all.sub.category') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>SubCategory List</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-header">Product</li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Product
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('add.products') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add-Product</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('all.products') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Product List</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('create.veriants.velua') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add-Product variants value </p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('veriants.value.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Product variants value List</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Product-Veriants
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('create.new.veriant') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add-Product-Veriant</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('veriants.list') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Product Vartiant List</p>
                            </a> </li>
                    </ul>
                </li>
                <li class="nav-header">Auth</li>
                <li class="nav-item"> <a href="{{ route('user.logout') }}" class="nav-link"> <i
                            class="fa-solid fa-right-from-bracket"></i>
                        <p>Logout</p>
                    </a> </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
