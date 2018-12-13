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
    $("form").validate({
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
});
