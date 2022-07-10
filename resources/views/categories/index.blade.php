@extends('layouts.app')
@section('page-title')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                               href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Category Management</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Category Management</h6>
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
                                           value="{{$_GET['name'] ?? ''}}"
                                           placeholder="Name" style="padding: 0.5rem 1rem !important;">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-info btn-outline-info btn-icon" id="btn-search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-3 mt-3">
                        <div class="d-flex justify-content-end">
                            @isPermission('category_create')
                            {{--                            <button type="button" id="btn-add-new-cate" data-tile="Create Category"--}}
                            {{--                                    class="btn btn-success mb-3" data-bs-toggle="modal"--}}
                            {{--                                    data-bs-target="#modal-form-create">Create New Categories--}}
                            {{--                            </button>--}}
                            <button type="button" id="btn-add-new-cate" data-tile="Create Category"
                                    class="btn btn-success btn-outline-success mb-3" data-bs-toggle="modal"
                                    data-bs-target="#modal-form-create">
                                <i class="fas fa-plus-circle"></i>
                                <span class="p-lg-1">Create</span>
                            </button>
                            @endisPermission
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div id="list" data-action="{{route('categories.list')}}">

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
    @isPermission('category_create')
    @include('categories.create')
    @endisPermission

    @isPermission('category_edit')
    <div class="modal fade" id="modal-form-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-body">
                            <h5 class="text-center">Edit Category</h5>
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
    <script src="/js/category.js"></script>
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
