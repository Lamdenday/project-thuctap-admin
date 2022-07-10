const AdminRole = (function () {
    let modules = {};

    modules.delete = function (url) {
        Base.callApiNormally(url, {}, 'delete')
            .done(function (res) {
                CustomAlert.modalSuccess('Delete role success');
            })
            .fail(function (res) {
                CustomAlert.modalError();
            });
    };
    return modules;
}(window.jQuery, window, document));
$(document).ready(function () {
    $(document).on('click', '.btn-delete-role', function () {
        let name = $(this).data('name-show');
        let url = $(this).data('action');
        Base.confirmDelete(name).then(
            function () {
                AdminRole.delete(url);
            }
        );
    });
});
