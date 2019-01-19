$("#sendform").validate({
    rules: {
        minutes: {
            required: true,
            number: true,
            min: 0.01,
            digits: true
        }
    }
});