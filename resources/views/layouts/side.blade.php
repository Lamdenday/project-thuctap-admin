<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3  bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
           target="_blank">
            <img src="/templates/admin/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">  {{ config('app.name', 'Laravel') }}</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white @if(Route::is('home')) active bg-gradient-primary @endif"
                   href="{{route('home')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if(Route::is('roles.index')||Route::is('roles.create')||Route::is('roles.edit')||Route::is('roles.show')) active bg-gradient-primary @endif"
                   href="{{route('roles.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Manage Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if(Route::is('users.index')||Route::is('users.create')||Route::is('users.edit')||Route::is('users.show')) active bg-gradient-primary @endif"
                   href="{{route('users.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Manage User</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @if(Route::is('categories.index')||Route::is('categories.create')||Route::is('categories.edit')||Route::is('categories.show')) active bg-gradient-primary @endif"
                   href="{{route('categories.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Manage Category</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @if(Route::is('products.index')||Route::is('products.create')||Route::is('products.edit')||Route::is('products.show')) active bg-gradient-primary @endif"
                   href="{{route('products.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Manage Product</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

