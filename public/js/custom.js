$(document).ready(function() {
    $('.btn-rent').on('click', function() {
        var carID = $(this).data('id');

        $.ajax({
            url: '/reservation/store',
            type: 'POST',
            data: {
                carID: carID,
            },
            success: function() {
                window.location.href = "/reservation";
            },
            error: function() {
            }
        });
    });
});