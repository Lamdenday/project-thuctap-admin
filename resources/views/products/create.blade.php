{{-- Modal Create --}}
<div class="modal fade" id="modal-form-create" tabindex="-1" role="dialog" aria-labelledby="modal-form"
     aria-hidden="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-body">
                        <h5 class="text-center">Create Product</h5>
                        <hr>
                        <div role="alert" class="alert alert-danger text-white visually-hidden validate-error"></div>

                        <form id="addProductForm" data-action="{{route('products.store')}}" name="ProductForm"
                              method="POST"
                              accept-charset="UTF-8"
                              class="form-control" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong class="form-check mb-1">Name: </strong>
                                                <div
                                                    class="form-check input-group input-group-dynamic info-horizontal mb-3">
                                                    <input placeholder="Name" class="form-control" name="title" id="title"
                                                           type="text">
                                                </div>
                                                <div class="text-danger form-check errors error-title"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong class="form-check mb-1">Category: </strong>
                                                <div class="form-check mb-3">
                                                    <select name="category_id" class="form-select border border-0">
                                                        {!! \App\Helpers\CategoryHelper::getCategoryMultiLevel($categories) !!}
                                                    </select>
                                                </div>
                                                <div class="text-danger form-check errors error-category"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong class="form-check mb-1">Price: </strong>
                                                <div
                                                    class="form-check input-group input-group-dynamic info-horizontal mb-3">
                                                    <input placeholder="Price" class="form-control" name="price"
                                                           id="price"
                                                           type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong class="form-check mb-1">Image: </strong>
                                        <div class="form-check mb-3">
                                            <div class="image-show">

                                            </div>

                                            <div class="col-12 mt-3">
                                                <label class="btn btn-default border border-1 text-xs">
                                                    <i class="fas fa-upload"></i>
                                                    <input type="file" style="display: none;" class="form-control image"
                                                           name="image" id="image">
                                                </label>
                                            </div>
                                            <div class="text-danger form-check errors error-image"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong class="form-check mb-1">Description: </strong>
                                        <div class="form-check input-group input-group-dynamic info-horizontal mb-3">
                                            <textarea class="form-control" name="description"
                                                      id="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="btn-create">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Create --}}
