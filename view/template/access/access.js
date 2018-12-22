/* @flow */
$(document).ready(function() {

    var invalidStrings = ['select', 'alter', 'update', 'delete'];

    function isValid(value, element, doCheck) {
        var good = true;
        if (doCheck) {
            for (var i = 0; i < invalidStrings.length; i++) {
                if (value.toLowerCase().includes(invalidStrings[i])) {
                    good = false;
                    break;
                }
            }
        }
        return this.optional(element) || good;
    }

    $.validator.addMethod("checkValid", isValid, "Please enter a diferent value.");
    $("#loginform").validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                checkValid: true
            },
            password: {
                required: true,
                minlength: 3,
                checkValid: true
            }
        }
    });

    $.validator.addMethod("checkValid", isValid, "Please enter a diferent value.");
    var isProvider = {
        depends: function(element) {
            return $("#typology option:selected").val() == "provider";
        }
    };
    $("#registerform").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                checkValid: true
            },
            surname: {
                required: true,
                minlength: 3,
                checkValid: true
            },
            username: {
                required: true,
                minlength: 3,
                checkValid: true
            },
            password: {
                required: true,
                minlength: 3,
                checkValid: true
            },
            rpassword: {
                required: true,
                minlength: 3,
                checkValid: true,
                equalTo: "#password"
            },
            birthdate: {
                required: true,
                date: true
            },
            telephone: {
                required: true,
                number: true,
                minlength: 5,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            },
            cityAddress: {
                required: isProvider,
                checkValid: true
            },
            addressStreet: {
                required: isProvider,
                checkValid: true
            },
            addressNumber: {
                required: isProvider,
                checkValid: true,
                digits: true
            },
            piva: {
                required: isProvider,
                minlength: 5,
                maxlength: 20,
                checkValid: true
            }
        }
    });

    $("#typology").change(function () {
        if ($("#typology option:selected").val() == "provider") {
            $("#providerFields").show();
        }
    });
    $("#typology").change(function () {
        if ($("#typology option:selected").val() == "client") {
            $("#providerFields").hide();
        }
    });
});
