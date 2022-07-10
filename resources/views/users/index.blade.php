@extends('layouts.app')
@section('page-title')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                               href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">User Management</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">User Management</h6>
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
                        <form class="form-search" method="GET" role="form">
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" class="form-control border" name="name"
                                           style="padding-left: 1rem !important;"
                                           value="{{$_GET['name'] ?? ''}}"
                                           placeholder="Name">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control border" name="email"
                                           style="padding-left: 1rem !important;"
                                           value="{{$_GET['email'] ?? ''}}"
                                           placeholder="Email">
                                </div>
                                <div class="col-3">
                                    <select name="role_id" class="form-control border"
                                            style="padding-left: 1rem !important;">
                                        <option value=" ">All</option>
                                        @foreach($roles as $key => $role)
                                            <option
                                                @if(isset($_GET['role_id'])) {{$_GET['role_id'] == $role->id ? 'selected' : ''}}  @endif
                                                value="{{$role->id}}">{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-vimeo" id="btn-search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @isPermission('user_create')
                    <div class="col-3 mt-3">
                        <div class="d-flex justify-content-end">
                            <button type="button" id="btn-add-new-user" data-tile="Create User"
                                    class="btn btn-success mb-3" data-bs-toggle="modal"
                                    data-bs-target="#modal-form-create">
                                <i class="fas fa-plus-circle"></i>
                                <span class="p-lg-1">Create</span>
                            </button>
                        </div>
                    </div>
                    @endisPermission
                </div>

                <div class="card">
                    <div id="list" data-action="{{ route('users.list' )}}">

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

    @isPermission('user_create')
    @include('users.create')
    @endisPermission

    @isPermission('user_edit')
    <div class="modal fade" id="modal-form-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-body">
                            <h5 class="text-center">Edit User</h5>
                            <hr>
                        </div>
                        <div id="edit">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisPermission

@endsection

@section('footer')
    <script src="/js/user.js"></script>
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
