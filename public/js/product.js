const AdminProduct = (function () {
    let modules = {};

    modules.resetForm = function (e) {
        e.trigger('reset');
        $(".avatar_show").attr("src", '');
    }

    modules.resetError = function () {
        let arrNameError = [
            {'className': 'error-title'},
            {'className': 'error-category'},
            {'className': 'error-image'},
        ];
        CustomAlert.resetError(arrNameError);
    }

    modules.getList = function (url, data) {
        Base.callApiNormally(url, data)
            .then(function (res) {
                $('#list').html('');
                $('#list').append(res);
            });
    };

    modules.create = function () {
        let url = $('#addProductForm').data('action');
        let data = new FormData(document.getElementById('addProductForm'));
        let image = $('.image').get(0).files[0];
        data.append('image', image);

        Base.callApiData(url, data, 'POST')
            .then(function (res) {
                $('#modal-form-create').modal('hide');
                AdminProduct.resetForm($('#addProductForm'));
                AdminProduct.resetError();
                AdminProduct.getList($('#list').data('action'));
                CustomAlert.modalSuccess(res.message);
                console.log(res);
            })
            .catch(function (res) {
                console.log(res);
                let arrayErrors = [
                    {'className': 'error-title', 'error': res.responseJSON.errors.title},
                    {'className': 'error-category', 'error': res.responseJSON.errors.category_id},
                    {'className': 'error-image', 'error': res.responseJSON.errors.image},
                ];
                CustomAlert.showError(arrayErrors);
            });
    };

    modules.show = function (url) {
        Base.callApiNormally(url)
            .then(function (res) {
                $('#edit').html('');
                $('#edit').append(res);
            })
            .fail(function () {
                $('#modal-form-edit').modal('hide');
                CustomAlert.modalError();
            })
    };

    modules.edit = function () {
        let url = $('#editProductForm').data('action');
        let data = new FormData(document.getElementById('editProductForm'));
        let image = $('.image').get(0).files[0];
        data.append('image', image ? image : '');
        Base.callApiData(url, data, 'post')
            .done(function (res) {
                $('#modal-form-edit').modal('hide');
                AdminProduct.resetForm($('#editProductForm'));
                AdminProduct.resetError();
                AdminProduct.getList($('#list').data('action'));
                CustomAlert.modalSuccess(res.message);
            })
            .fail(function (res) {
                console.log(res);
                let arrayErrors = [
                    {'className': 'error-title', 'error': res.responseJSON.errors.title},
                    {'className': 'error-category', 'error': res.responseJSON.errors.category_id},
                    {'className': 'error-image', 'error': res.responseJSON.errors.image},
                ];
                CustomAlert.showError(arrayErrors);
            });
    };

    modules.delete = function (url) {
        Base.callApiNormally(url, {}, 'delete')
            .done(function (res) {
                AdminProduct.getList($('#list').data('action'));
                CustomAlert.modalSuccess('Delete Product Success');
            })
            .fail(function (res) {
                CustomAlert.modalError();
            });
    }

    return modules;
}(window.jQuery, window, document));


const AdminImage = (function () {
    let modules = {};

    modules.showImage = function (e) {
        let file = e.get(0).files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function () {
                $('.image-show').html('').append('<div class="overlay"> ' +
                    '<button class="text-white bg-danger move-on-hover btn-delete-image" style="z-index: 1">X</button></div>' +
                    '<img src="' + reader.result + '" width="200" height="300">').css('border', '1px solid #eb4b64');
            }
            reader.readAsDataURL(file);
        }
    };

    modules.deleteImage = function () {
        $('.image-show').html('').css('border', '0');
    };

    return modules;
}(window.jQuery, window, document));


$(document).ready(function () {

    AdminProduct.getList($('#list').data('action'));

    $(document).on('click', '.page-link', function (e) {
        let url = $(this).attr('href');
        e.preventDefault();
        AdminProduct.getList(url);
    });

    $(document).on('change', '.image', function () {
        AdminImage.showImage($(this));
    });

    $(document).on('click', '.btn-delete-image', function (e) {
        e.preventDefault();

        AdminImage.deleteImage();
    });

    $(document).on('click', '#btn-create', function (e) {
        e.preventDefault();
        AdminProduct.resetError();
        AdminProduct.create();
    });

    $(document).on('click', '#btn-add-new-product', function (e) {
        AdminProduct.resetError();
        AdminImage.deleteImage();
    });

    $(document).on('click', '.btn-edit-product', function (e) {
        let url = $(this).data('action');
        AdminProduct.show(url);
    });

    $(document).on('click', '#btn-edit', function (e) {
        e.preventDefault();
        AdminProduct.resetError();
        AdminProduct.edit();
    });

    $(document).on('click', '.btn-delete-product', function () {
        let name = $(this).data('name-show');
        let url = $(this).data('action');
        Base.confirmDelete(name).then(
            function () {
                AdminProduct.delete(url);
            }
        );
    });

    $(document).on('click', '#btn-search', function (e) {
        e.preventDefault();
        let data = $('.form-search').serialize();
        let url = $('#list').data('action');
        AdminProduct.getList(url, data);
    });
});
