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
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Create New Role</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
                <form action="{{route('roles.store')}}" method="post">
                    @csrf
                    <strong class="form-check mb-2">Name: </strong>
                    <div class="form-check input-group input-group-dynamic info-horizontal">
                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{old('name')}}">
                    </div>
                    @error('name')
                    <div class="form-check text-danger">{{ $message }}</div>
                    @enderror
                    <br/>
                    <strong class="form-check mb-2">Display_Name: </strong>
                    <div class="form-check input-group input-group-dynamic info-horizontal mb-2">
                        <input type="text" class="form-control" placeholder="Display_name"
                               name="display_name" value="{{old('display_name')}}">
                    </div>
                    @error('name')
                    <div class="form-check text-danger">{{ $message }}</div>
                    @enderror
                    <br/>
                    <strong class="form-check mb-2">Permission: </strong>

                    <div class="form-check">
                        <div class="form-check mx-3">
                            <input type="checkbox" class="form-check-input checkall">
                            <label style="font-size: 1.1rem;">Check all</label>
                        </div>
                        <br>
                        @foreach($permissionGroup as $group => $permission)
                            <div class="card mb-3 col-md-12">
                                <div class="card-header bg-gray-400">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkbox_wrapper">
                                        <label class="custom-control-label text-dark"
                                        >{{ ucfirst($group) }}</label>
                                    </div>
                                </div>
                                <div class="row p-2 pb-0">
                                    @foreach($permission as $permissionItem)
                                        <div class="card-body col-3 ">
                                            <div class="form-check">
                                                <input class="form-check-input p-0 checkbox_childrent" type="checkbox"
                                                       name="permission[]"
                                                       value="{{ $permissionItem->id }}">
                                                <label class="p-0">
                                                    {{ $permissionItem->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <br>
                    <br>
                    <br>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
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
