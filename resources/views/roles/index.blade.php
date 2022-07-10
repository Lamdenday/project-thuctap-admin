@extends('layouts.app')
@php
    $stt = (($_GET['page'] ?? 1) - 1) * 5;
@endphp
@section('page-title')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                               href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Role Management</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Role Management</h6>
@endsection
@section('content')
    <div class="g-sidenav-show bg-gray-200">
        @include('layouts.side')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
        @include('layouts.navbar')
        <!-- End Navbar -->
            <div class="container">
                <div class="row">
                    <div class="col-9 mt-3">
                        <form action="" method="GET" role="form">
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" class="form-control border" name="name"
                                           value="{{$_GET['name'] ?? ''}}" style="padding-left: 1rem !important;"
                                           placeholder="Name">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-vimeo">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @isPermission('role_create')
                    <div class="col-3 mt-3">
                        <div class="d-flex justify-content-end mt-3">
                            <a class="btn btn-success" href="{{route('roles.create')}}">
                                <i class="fas fa-plus-circle"></i>
                                <span class="p-lg-1">Create</span>
                            </a>
                        </div>
                    </div>
                    @endisPermission
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p class="text-white">{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    style="width: 3.5rem;">No
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Name
                                </th>
                                <th class="text-secondary opacity-7" style="width: 15rem;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="table">
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td class="text-center ">{{ ++$stt }}</td>
                                    <td>
                                        <p class="text-xl font-weight-bold mb-0">{{ $role->display_name }}</p>
                                    </td>
                                    <td class="align-middle">
                                        <a class="btn btn-info text-white btn-icon mt-3 font-weight-bold"
                                           href="{{ route('roles.show',$role->id) }}"
                                           style="width: 61.5px">
                                            <i class="fas fa-info-circle fa-lg"></i>
                                        </a>
                                        @isPermission('role_edit')
                                        <a class="btn btn-primary text-white btn-icon mt-3 text-xxs"
                                           href="{{ route('roles.edit',$role->id) }}">
                                            <i class="fas fa-edit fa-lg"></i>
                                        </a>
                                        @endisPermission
                                        @isPermission('role_delete')
                                        <button type="button"
                                                class="btn btn-danger text-white btn-icon mt-3 btn-delete-role"
                                                data-action="{{route('roles.destroy', $role->id)}}"
                                                data-name-show="{{$role->display_name}}">
                                            <i class="fas fa-trash fa-lg"></i>
                                        </button>
                                        @endisPermission
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {!! $roles->links() !!}
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <footer class="footer py-4">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-lg-between">
                            <div class="col-lg-6 mb-lg-0 mb-4">
                                <div class="copyright text-center text-sm text-muted text-lg-start">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                    ,
                                    made with <i class="fa fa-heart"></i> by
                                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                        Tim</a>
                                    for a better web.
                                </div>
                            </div>
                            <div class="col-lg-6">

                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </main>
    </div>
@endsection

@section('footer')
    <script src="/js/role.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
@endsection
