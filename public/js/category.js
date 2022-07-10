const AdminCategory = (function () {
    let modules = {};

    modules.resetForm = function (e) {
        e.trigger('reset');
    }

    modules.resetError = function () {
        let arrNameError = [{'className': 'error-name'}];
        CustomAlert.resetError(arrNameError);
    }

    modules.getList = function (url, data) {
        Base.callApiNormally(url, data)
            .then(function (res) {
                $('#list').html('').append(res);
            })
            .catch((res)=> console.log(res));
    };

    modules.create = function () {
        let data = $('#addCateForm').serialize();
        let url = $('#addCateForm').data('action');
        Base.callApiNormally(url, data, 'POST')
            .done(function (res) {
                AdminCategory.resetForm($('#addCateForm'));
                $('#modal-form-create').modal('hide');
                AdminCategory.resetError();
                AdminCategory.getList($('#list').data('action'));
                CustomAlert.modalSuccess(res.message);
            })
            .fail(function (res) {
                let arrayErrors = [
                    {'className': 'error-name', 'error': res.responseJSON.errors.name}
                ];
                CustomAlert.showError(arrayErrors);
            });
    };

    modules.show = function (url) {
        Base.callApiNormally(url)
            .then(function (res) {
                $('#edit').html('').append(res);
            })
            .fail(function () {
                $('#modal-form-edit').modal('hide');
                CustomAlert.modalError();
            })
    };

    modules.edit = function () {
        let data = $('#editCateForm').serialize();
        let url = $('#editCateForm').data('action');
        Base.callApiNormally(url, data, 'PUT')
            .done(function (res) {
                AdminCategory.resetForm($('#editCateForm'));
                $('#modal-form-edit').modal('hide');
                AdminCategory.resetError();
                AdminCategory.getList($('#list').data('action'));
                CustomAlert.modalSuccess(res.message);
            })
            .fail(function (res) {
                AdminCategory.resetError();
                let arrayErrors = [
                    {'className': 'error-name', 'error': res.responseJSON.errors.name}
                ];
                CustomAlert.showError(arrayErrors);
            });
    };

    modules.delete = function (url) {
        Base.callApiNormally(url, {}, 'delete')
            .done(function (res) {
                AdminCategory.getList($('#list').data('action'));
                CustomAlert.modalSuccess('Delete category success');
            })
            .fail(function (res) {
                CustomAlert.modalError();
            });
    };
    return modules;
}(window.jQuery, window, document));
$(document).ready(function () {

    AdminCategory.getList($('#list').data('action'));

    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        AdminCategory.getList(url);
    });

    $('#btn-add-new-cate').on('click', function () {
        AdminCategory.resetForm($('#addCateForm'));
        AdminCategory.resetError();
    });

    $(document).on('click', '#btn-create', function (e) {
        e.preventDefault();
        AdminCategory.resetError();
        AdminCategory.create();
    });

    $(document).on('click', '.btn-edit-cate', function (e) {
        let url = $(this).data('action');
        AdminCategory.show(url);
    });

    $(document).on('click', '#btn-edit', function (e) {
        e.preventDefault();
        AdminCategory.resetError();
        AdminCategory.edit();
    });

    $(document).on('click', '.btn-delete-cate', function () {
        let name = $(this).data('name-show');
        let url = $(this).data('action');
        Base.confirmDelete(name).then(
            function () {
                AdminCategory.delete(url);
            }
        );
    });

    $(document).on('click', '#btn-search', function (e) {
        e.preventDefault();
        let data = $('.form-search').serialize();
        let url = $('#list').data('action');
        AdminCategory.getList(url, data);
    });
});
