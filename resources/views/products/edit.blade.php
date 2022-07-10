<form id="editProductForm" data-action="{{route('products.update', $product->id)}}" name="ProductForm" method="post"
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
                                   type="text" value="{{$product->title}}">
                        </div>
                        <div class="text-danger form-control errors error-title"></div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong class="form-check mb-1">Category: </strong>
                        <div class="form-check mb-3">
                            <select name="category_id" class="form-select">
                                {!! \App\Helpers\CategoryHelper::getCategoryMultiLevel($categories) !!}
                            </select>
                        </div>
                        <div class="text-danger form-control errors error-category"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                <div class="form-group">
                    <strong class="form-check mb-1">Price: </strong>
                    <div
                        class="form-check input-group input-group-dynamic info-horizontal mb-3">
                        <input placeholder="Price" class="form-control" name="price" id="price"
                               type="number" value="{{$product->price}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="form-check mb-1">Image: </strong>
                <div class="form-check mb-3">
                    <div class="image-show">
                        <div class="overlay">
                            <button class="text-white bg-danger btn-delete-image"
                                    style="z-index: 1">X
                            </button>
                        </div>
                        <img src="{{asset('product_images/'.$product->image_url)}}" width="200" height="300">
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
                                                      id="description">{{$product->description}}</textarea>
                </div>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">
                Cancle
            </button>
            <button type="submit" class="btn btn-primary" id="btn-edit">
                Save
            </button>
        </div>
    </div>
</form>
