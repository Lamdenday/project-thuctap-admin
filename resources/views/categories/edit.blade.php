<form action="" id="editCateForm" method="POST" data-action="{{route('categories.update', $category->id)}}"
      accept-charset="UTF-8"
      class="form-control">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="form-group">
                <strong class="form-check mb-1">Name: </strong>
                <div
                    class="form-check input-group input-group-dynamic info-horizontal mb-3">
                    <input placeholder="Name" class="form-control" name="name" id="name"
                           type="text" value="{{$category->name}}">
                </div>
                <div class="text-danger form-control errors error-name"></div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
            <button class="btn btn-primary" id="btn-edit">
                Save
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
            </button>
        </div>
    </div>
</form>
