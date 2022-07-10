const AdminOrder = (function () {
    let modules = {};
    modules.resetForm = function (e) {
        e.trigger('reset');
    }

    modules.resetError = function () {
        let arrNameError = [
            {'className': 'error-name'},
            {'className': 'error-phone-number'},
            {'className': 'error-email'},
            {'className': 'error-password'},
            {'className': 'error-roles'},
        ];
        CustomAlert.resetError(arrNameError);
    }

    modules.getList = function (url, data) {
        Base.callApiNormally(url, data)
            .then(function (res) {
                $('#list').html('').append(res);
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

    modules.create = function () {
        let data = $('#addOrderForm').serialize();
        let url = $('#addOrderForm').data('action');
        Base.callApiNormally(url, data, 'POST')
            .done(function (res) {
                AdminOrder.resetForm($('#addOrderForm'));
                $('#modal-form-create').modal('hide');
                AdminOrder.resetError();
                AdminOrder.getList($('#list').data('action'));
                CustomAlert.modalSuccess(res.message);
            })
            .fail(function (res) {
                let errors = res.responseJSON.errors;
                let arrayErrors = [
                    {'className': 'error-name', 'error': errors.name},
                    {'className': 'error-phone-number', 'error': errors.phone_number},
                    {'className': 'error-email', 'error': errors.email},
                    {'className': 'error-password', 'error': errors.password},
                    {'className': 'error-roles', 'error': errors.roles},
                ];
                CustomAlert.showError(arrayErrors);
            });
    };

    modules.edit = function () {
        let data = $('#editOrderForm').serialize();
        let url = $('#editOrderForm').data('action');
        Base.callApiNormally(url, data, 'PUT')
            .done(function (res) {
                AdminOrder.resetForm($('#editOrderForm'));
                $('#modal-form-edit').modal('hide');
                AdminOrder.resetError();
                AdminOrder.getList($('#list').data('action'));
                CustomAlert.modalSuccess(res.message);
            })
            .fail(function (res) {
                AdminOrder.resetError();
                let errors = res.responseJSON.errors;
                let arrayErrors = [
                    {'className': 'error-name', 'error': errors.name},
                    {'className': 'error-phone-number', 'error': errors.phone_number},
                    {'className': 'error-email', 'error': errors.email},
                    {'className': 'error-password', 'error': errors.password},
                    {'className': 'error-roles', 'error': errors.roles},
                ];
                CustomAlert.showError(arrayErrors);
            });
    };

    modules.delete = function (url) {
        Base.callApiNormally(url, {}, 'delete')
            .done(function (res) {
                AdminOrder.getList($('#list').data('action'));
                CustomAlert.modalSuccess('Delete Order success');
            })
            .fail(function (res) {
                CustomAlert.modalError();
            });
    };

    return modules;
}(window.jQuery, window, document));
$(document).ready(function () {

    AdminOrder.getList($('#list').data('action'));

    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        AdminOrder.getList(url);
    });

    $(document).on('click', '#btn-create', function (e) {
        e.preventDefault();
        AdminOrder.resetError();
        AdminOrder.create();
    });

    $(document).on('click', '.btn-edit-Order', function (e) {
        let url = $(this).data('action');
        AdminOrder.show(url);
    });

    $(document).on('click', '#btn-edit', function (e) {
        e.preventDefault();
        AdminOrder.resetError();
        AdminOrder.edit();
    });

    $(document).on('click', '.btn-delete-Order', function () {
        let name = $(this).data('name-show');
        let url = $(this).data('action');
        Base.confirmDelete(name).then(
            function () {
                AdminOrder.delete(url);
            }
        );
    });

    $(document).on('click', '#btn-search', function (e) {
        e.preventDefault();
        let data = $('.form-search').serialize();
        let url = $('#list').data('action');
        console.log(data);
        console.log(url);
        AdminOrder.getList(url, data);
    });
});
