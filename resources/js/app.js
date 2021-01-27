require('./bootstrap');
import Swal from 'sweetalert2';

$(document).ready(function () {

    const storeLibrary = (e) => {
        e.stopImmediatePropagation();

        let form = $('#library-form');
        let storeLibraryUrl = form.prop('action');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: storeLibraryUrl,
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {

                if (data.status === 200) {

                    Swal.fire({
                        title: 'Success',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'CLOSE'

                    }).then(() => {

                        $('#add-library-modal').fadeOut();
                        window.location.reload(true);

                    }).catch(() => {

                        Swal.fire({
                            title: 'Error',
                            text: 'There\'s an error occurred',
                            icon: 'error',
                            confirmButtonText: 'CLOSE'
                        })

                    });
                }
            },
            error: function (data) {
                console.log(data);

                if (data.status === 500) {

                    Swal.fire({
                        title: 'Error',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'CLOSE'

                    }).then(() => {

                        $('#add-library-modal').fadeOut();

                    });
                }
            }
        });
    }

    const removeLibrary = (e, libraryId, url) => {
        e.stopImmediatePropagation();

        let removeLibraryUrl = url;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: removeLibraryUrl,
            data: {
                '_method': 'DELETE'
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);

                if (data.status === 200) {

                    Swal.fire({
                        title: 'Success',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'CLOSE'

                    }).then(() => {

                        $('#confirmation-modal').fadeOut();
                        window.location.reload(true);

                    }).catch(() => {

                        Swal.fire({
                            title: 'Error',
                            text: 'There\'s an error occurred',
                            icon: 'error',
                            confirmButtonText: 'CLOSE'
                        })

                    });
                }
            },
            error: function (data) {
                console.log(data);

                Swal.fire({
                    title: 'Error',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'CLOSE'

                }).then(() => {

                    $('#confirmation-modal').fadeOut();

                });
            }
        });
    }


    const removeBook = (e, bookId, url) => {
        e.stopImmediatePropagation();

        let removeBookUrl = url

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: removeBookUrl,
            data: {
                '_method': 'DELETE'
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                let redirectUrl = data.redirect_url;

                if (data.status === 200) {

                    Swal.fire({
                        title: 'Success',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'CLOSE'
                    }).then(() => {

                        $('#confirmation-modal').fadeOut();
                        window.location.href = redirectUrl;

                    }).catch(() => {

                        Swal.fire({
                            title: 'Error',
                            text: 'There\'s an error occurred',
                            icon: 'error',
                            confirmButtonText: 'CLOSE'
                        })

                    });
                }
            },
            error: function (data) {
                console.log(data);

                Swal.fire({
                    title: 'Error',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'CLOSE'

                }).then(() => {

                    $('#confirmation-modal').fadeOut();

                });
            }
        });
    }

    const storeBook = (e, libraryId) => {
        e.stopImmediatePropagation();

        let form = $('#book-form');
        let storeBookUrl = form.prop('action');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: storeBookUrl,
            data: form.serialize() + "&library_id=" + JSON.stringify(libraryId),
            dataType: 'json',
            success: function (data) {
                console.log(data);

                if (data.status === 200) {

                    Swal.fire({
                        title: 'Success',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'CLOSE'

                    }).then(() => {

                        $('#add-book-modal').fadeOut();
                        window.location.reload(true);

                    }).catch(() => {

                        Swal.fire({
                            title: 'Error',
                            text: 'There\'s an error occurred',
                            icon: 'error',
                            confirmButtonText: 'CLOSE'
                        })

                    });
                }
            },
            error: function (data) {
                console.log(data.status);

                if (data.status === 422) {
                    let errors = Array.from(Object.entries(data.responseJSON.errors));
                    let validationErrors = errors.reduce((a, b) => a + b).split('.');
                    data.message = validationErrors;
                }

                Swal.fire({
                    title: 'Error',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'CLOSE'

                }).then(() => {

                    $('#add-book-modal').fadeOut();
                });

            }
        });
    }


    $('#add-library-button').on('click', (e) => {
        e.stopImmediatePropagation();

        $('#add-library-modal').fadeIn();
        $('#confirm-add-library').on('click', storeLibrary);
    })

    $('.add-book-button').on('click', (e) => {
        e.stopImmediatePropagation();

        const libraryId = $(e.currentTarget).data('library');

        $('#add-book-modal').fadeIn();
        $('#confirm-add-book').on('click', (e) => storeBook(e, libraryId));
    })


    $('.remove-book-button').on('click', (e) => {
        e.stopImmediatePropagation();
        e.preventDefault();

        const bookId = $(e.currentTarget).data('book-id');
        const url = $(e.currentTarget).data('url');
        console.log(url)

        $('#confirmation-modal').fadeIn();
        $('#confirm-remove-library-button').on('click', (e) => removeBook(e, bookId, url));
    });

    $('.remove-library-button').on('click', (e) => {
        e.stopImmediatePropagation();

        const libraryId = $(e.currentTarget).data('library');
        const url = $(e.currentTarget).data('url');

        $('#confirmation-modal').fadeIn();
        $('#confirm-remove-library-button').on('click', (e) => removeLibrary(e, libraryId, url));
    });

    $('#cancel-remove-library-button').on('click', (e) => {
        $('#confirmation-modal').fadeOut();
    });

    $('#cancel-add-library').on('click', (e) => {
        e.stopImmediatePropagation();

        $('#add-library-modal').fadeOut();
    });

    $('#cancel-add-book').on('click', (e) => {
        $('#add-book-modal').fadeOut();
    });

    $('#add-multiple-books').select2();

});
