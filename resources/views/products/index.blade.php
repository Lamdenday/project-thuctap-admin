@extends('layouts.app')

@section('page-title')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                               href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Product Management</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Product Management</h6>
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
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Open Search
                        </button>
                        <div class="collapse" id="collapseExample">
                            <form class="row m-2 mt-4 form-search" method="get" role="form">
                                <div class="col-12 m-2">
                                    <div class="row">
                                        <div class="col-5">
                                            <input type="text" class="form-control border" name="name" id="name_search"
                                                   value="{{$_GET['title'] ?? ''}}"
                                                   placeholder="Name">
                                        </div>
                                        <div class="col-5">
                                            <select class="form-select" name="category_id" id="category_id"
                                                    style="padding-left: 1rem !important;border:0px;">
                                                <option value=" ">All</option>
                                                {!! \App\Helpers\CategoryHelper::getCategoryMultiLevel($categories) !!}
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-vimeo" id="btn-search">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m-2 mb-4">
                                    <div class="row">
                                        <div class="col-5">
                                            <input type="number" class="form-control border" name="min_price"
                                                   value="{{$_GET['min_price'] ?? ''}}" id="min-price"
                                                   placeholder="Price min">
                                        </div>
                                        <span class="mt-2" style="width: 0px;font-weight: bold; padding: 0">-</span>
                                        <div class="col-5">
                                            <input type="number" class="form-control border" name="max_price"
                                                   value="{{$_GET['max_price'] ?? ''}}" id="max-price"
                                                   placeholder="Price max">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @isPermission('product_create')
                    <div class="col-3 mt-3">
                        <div class="d-flex justify-content-end">
                            <button type="button" id="btn-add-new-product" data-tile="Create Product"
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
                    <div id="list" data-action="{{route('products.list')}}">

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

    @isPermission('product_create')
    @include('products.create')
    @endisPermission

    @isPermission('product_edit')
    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-form-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form"
         aria-hidden="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-body">
                            <h5 class="text-center">Edit Product</h5>
                            <hr>
                            <div role="alert"
                                 class="alert alert-danger text-white visually-hidden validate-error"></div>
                            <div id="edit">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit --}}
    @endisPermission
@endsection

@section('footer')
    <style>
        .collapse .form-control {
            padding-left: 1rem !important;
        }

        .image-show {
            position: relative;
            display: inline-block;
        }

        .overlay {
            position: absolute;
            z-index: 5;
            top: -1em;
            right: -1em;
        }

        .btn-delete-image {
            width: 1.6rem;
            height: 1.6rem;
            border: 0;
            border-radius: 50%;
        }
    </style>
    <script src="/js/product.js"></script>
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
