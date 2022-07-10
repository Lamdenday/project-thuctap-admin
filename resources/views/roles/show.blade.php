@extends('layouts.app')

@section('content')
    <div class="g-sidenav-show bg-gray-200">
        @include('layouts.side')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
        @include('layouts.navbar')
        <!-- End Navbar -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-start" style="display: inline-block !important;">
                            <h2>Show Role</h2>
                        </div>
                        <div class="d-flex justify-content-end"
                             style="display: inline-block !important;float: right">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">ID</dt>
                        <dd class="col-sm-10">{{$role->id}}</dd>
                        <dt class="col-sm-2">Name</dt>
                        <dd class="col-sm-10">{{$role->name}}</dd>
                        <dt class="col-sm-2">Display_Name</dt>
                        <dd class="col-sm-10">{{$role->display_name}}</dd>
                        <dt class="col-sm-2">Permission</dt>
                        <dd class="col-sm-10">
                            @php
                                $permissions = $role->rolePermissions
                            @endphp
                            @foreach($permissions as $permission)
                                <span style="font-size: 12px"
                                      class="badge bg-gradient-primary">{{ $permission->display_name }}</span>
                            @endforeach
                        </dd>
                    </dl>
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
