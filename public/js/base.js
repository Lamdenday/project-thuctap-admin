$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const Base = (function () {
    let modules = {};

    modules.resetErrors = function () {
        $('.errors').html('');
    };

    modules.callApiData = function (url, data = {}, method = 'get') {
        return $.ajax({
            url: url,
            data: data,
            method: method,
            contentType: false,
            processData: false,
        })
    }

    modules.callApiNormally = function (url, data = {}, method = 'get') {
        return $.ajax({
            url: url,
            data: data,
            method: method,
        })
    }

    modules.confirmDelete = function (name) {
        return new Promise((resolve, reject) => {
            Swal.fire({
                title: 'Are you sure ' + name + ' ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    resolve(true);
                } else {
                    reject(false);
                }
            })
        })
    }

    modules.checkGroup = function (classParent, classChildrent, e) {
        e.parents(classParent).find(classChildrent).prop('checked', e.prop('checked'));
    }

    return modules;
}(window.jQuery, window, document));

const CustomAlert = (function () {
    let modules = {};

    modules.modalSuccess = function (message) {
        Swal.fire(
            message,
            '',
            'success'
        )
    };

    modules.showError = function (arr) {
        arr.forEach(function (value) {
            $('.' + value.className).html(value.error);
        });
    };

    modules.resetError = function (arr) {
        arr.forEach(function (value) {
            $('.' + value.className).html('');
        });
    };

    modules.modalError = function (error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        })
    };

    return modules;
}(window.jQuery, window, document));


$(document).ready(function () {

    $('.checkbox_wrapper').on('click', function () {
        Base.checkGroup('.card', '.checkbox_childrent', $(this));
    });

    $('.checkall').on('click', function () {
        Base.checkGroup('', '.checkbox_childrent', $(this));
        Base.checkGroup('', '.checkbox_wrapper', $(this));
    });
});
