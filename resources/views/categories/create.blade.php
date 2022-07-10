{{-- Modal Create--}}
<div class="modal fade" id="modal-form-create" tabindex="-1" role="dialog" aria-labelledby="modal-form"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-body">
                        <h5 class="text-center">Create Category</h5>
                        <hr>
                        <div role="alert" class="alert alert-danger text-white visually-hidden validate-error">

                        </div>
                        <form action="" id="addCateForm" method="POST" data-action={{route('categories.store')}}
                            accept-charset="UTF-8"
                              class="form-control">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                    <div class="form-group">
                                        <strong class="form-check mb-1">Name: </strong>
                                        <div
                                            class="form-check input-group input-group-dynamic info-horizontal mb-3">
                                            <input placeholder="Name" class="form-control" name="name" id="name"
                                                   type="text">
                                        </div>
                                        <div class="text-danger form-control errors error-name"></div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                                    <button class="btn btn-primary" id="btn-create">
                                        Create
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
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
{{--End model create--}}
