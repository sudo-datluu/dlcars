$(function () {
    function changeTotal () {
        var form = document.getElementById('RForm')
        var startRF = moment($('#durationRForm').data('daterangepicker').startDate.format("YYYY-MM-DD"))
        var endRF = moment($('#durationRForm').data('daterangepicker').endDate.format("YYYY-MM-DD"))
        var durationRF = endRF.diff(startRF, 'days') + 1;

        $('#RFTotal').html((form.qtyRForm.value * carPrice * durationRF).toFixed(2))
    }

    function validateRForm() {
        let form = document.getElementById('RForm');
        let isValid = true;

        if (form.nameRForm.value.trim() === '') {
            form.nameRForm.classList.add('is-invalid');
            isValid = false;
        } else {
            form.nameRForm.classList.remove('is-invalid');
        }

        const licensePattern = /^[A-Za-z0-9]{9}$/;
        if (!licensePattern.test(form.licenseRForm.value)) {
            form.licenseRForm.classList.add('is-invalid');
            isValid = false;
        } else {
            form.licenseRForm.classList.remove('is-invalid');
        }

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(form.emailRForm.value)) {
            form.emailRForm.classList.add('is-invalid');
            isValid = false;
        } else {
            form.emailRForm.classList.remove('is-invalid');
        }

        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test(form.phoneRForm.value)) {
            form.phoneRForm.classList.add('is-invalid');
            isValid = false;
        } else {
            form.phoneRForm.classList.remove('is-invalid');
        }

        if (form.qtyRForm.value > carQty || !form.qtyRForm.value) {
            form.qtyRForm.classList.add('is-invalid');
            isValid = false;
        } else {
            form.qtyRForm.classList.remove('is-invalid');
        }

        changeTotal()

        return isValid
    }

    $('input[name="durationRForm"]').daterangepicker({
        opens: 'left',
        autoUpdateInput: true,
        minDate:new Date(),
        locale: {
            format: 'DD MMM YYYY',
            cancelLabel: 'Clear'
        }
    }, function (start, end, label) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "reservation/store",
            data: {
                startDate: start.format('YYYY-MM-DD'),
                endDate: end.format('YYYY-MM-DD')
            }
        })
        changeTotal()
    });

    if (validateRForm()) {
        document.getElementById('RForm-submit-btn').classList.remove('disabled')
    }

    $('#RForm').on('input change', function (){
        document.getElementById('RForm-submit-btn').classList.remove('disabled')
        var startRF = moment($('#durationRForm').data('daterangepicker').startDate.format("YYYY-MM-DD"))
        var endRF = moment($('#durationRForm').data('daterangepicker').endDate.format("YYYY-MM-DD"))
        var durationRF = endRF.diff(startRF, 'days') + 1;

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "reservation/store",
            data: {
                carID: carID,
                qty: this.qtyRForm.value,
                name: this.nameRForm.value.trim(),
                license: this.licenseRForm.value,
                email: this.emailRForm.value,
                phone: this.phoneRForm.value,
                total: (this.qtyRForm.value * carPrice * durationRF).toFixed(2),
                startDate: $("#durationRForm").data('daterangepicker').startDate.format('YYYY-MM-DD'),
                endDate: $("#durationRForm").data('daterangepicker').endDate.format('YYYY-MM-DD')
            }
        })

        if(!validateRForm()) {
            document.getElementById('RForm-submit-btn').classList.add('disabled')
        } else {
            document.getElementById('RForm-submit-btn').classList.remove('disabled')
        }
    })

    $('#RForm-cancel-btn').on('click', function() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/reservation/clear",
        }).then(() => {
            window.location.href = "/"
        })
    })

    $('#RForm-submit-btn').on('click', function() {
        $.ajax({
            type: "POST",
            url: "/reservation/save",
            success: function (response) {
                var errors = response.errors
                // Success
                if (response.status) {
                    window.location.href = response.order_url
                }
                // Error
                else {
                    alert(errors)
                }
            }
        })
    })
});