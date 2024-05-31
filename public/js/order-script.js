$("#order-confirm-btn").on('click', function() {
    $.ajax({
        type: "POST",
        url: "/orders/" + orderID + "/confirm",
        success: function (response) {
            var errors = response.errors
            // Success
            if (response.status) {
                window.location.reload();
            }
            // Error
            else {
                alert(errors)
            }
        }
    })
})