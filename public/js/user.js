const AdminUser = (function () {
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
        let data = $('#addUserForm').serialize();
        let url = $('#addUserForm').data('action');
        Base.callApiNormally(url, data, 'POST')
            .done(function (res) {
                AdminUser.resetForm($('#addUserForm'));
                $('#modal-form-create').modal('hide');
                AdminUser.resetError();
                AdminUser.getList($('#list').data('action'));
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
        let data = $('#editUserForm').serialize();
        let url = $('#editUserForm').data('action');
        Base.callApiNormally(url, data, 'PUT')
            .done(function (res) {
                AdminUser.resetForm($('#editUserForm'));
                $('#modal-form-edit').modal('hide');
                AdminUser.resetError();
                AdminUser.getList($('#list').data('action'));
                CustomAlert.modalSuccess(res.message);
            })
            .fail(function (res) {
                AdminUser.resetError();
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
                AdminUser.getList($('#list').data('action'));
                CustomAlert.modalSuccess('Delete user success');
            })
            .fail(function (res) {
                CustomAlert.modalError();
            });
    };

    return modules;
}(window.jQuery, window, document));
$(document).ready(function () {

    AdminUser.getList($('#list').data('action'));

    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        AdminUser.getList(url);
    });

    $(document).on('click', '#btn-create', function (e) {
        e.preventDefault();
        AdminUser.resetError();
        AdminUser.create();
    });

    $(document).on('click', '.btn-edit-user', function (e) {
        let url = $(this).data('action');
        AdminUser.show(url);
    });

    $(document).on('click', '#btn-edit', function (e) {
        e.preventDefault();
        AdminUser.resetError();
        AdminUser.edit();
    });

    $(document).on('click', '.btn-delete-user', function () {
        let name = $(this).data('name-show');
        let url = $(this).data('action');
        Base.confirmDelete(name).then(
            function () {
                AdminUser.delete(url);
            }
        );
    });

    $(document).on('click', '#btn-search', function (e) {
        e.preventDefault();
        let data = $('.form-search').serialize();
        let url = $('#list').data('action');
        console.log(data);
        console.log(url);
        AdminUser.getList(url, data);
    });
});
