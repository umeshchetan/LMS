
// alert('hello')

$(function () {
    $registerData = $('#form');

    $registerData.validate({
        rules: {
            name: {
                required: true,
                lettersOnly: true
            },
            email: {
                required: true,
                email: true
            },
            gender: {
                required: true,

            },
            phone: {
                required: true,
                numericOnly: true,
                minlength: 10,
                maxlength: 12
            },
            date_of_birth: {
                required: 'true',
                future: true
            },
            password: {
                required: true
            },
            confirm_password: {
                required: true,
                equalTo: '#password'
            }

        },
        messages: {
            name: {
                required: 'User name is required',
                lettersOnly: 'Name must be letters only..'
            },
            email: {
                required: 'Email is required',
                email: 'Please enter valid email address'
            },
            gender: {
                required: 'Please select gender',
            },
            phone: {
                required: 'Phone number is required',
                numericOnly: "Enter numeric values only...",
                minlength: 'Minimum 10digits',
                maxlength: 'Maximum 12digits'
            },
            date_of_birth: {
                required: "Date field is required",
                future: 'Dob is in future'
            },
            password: {
                required: 'Password is required'
            },
            confirm_password: {
                required: 'C_Password is required',
                equalTo: 'Password mismatch'
            }
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parents(".gen"));
            } else {
                error.insertAfter(element);
            }
        }
    })


    // lettersOnly => both are same we can use jQuery.validator or $.validator
    // jQuery.validator.addMethod('lettersOnly', function (value, element) {
    //     return /^[a-zA-Z]+$/.test(value);
    // });

    $.validator.addMethod('lettersOnly', function (value, element) {
        return /^[a-zA-Z]+$/.test(value);
    });

    $.validator.addMethod('numericOnly', function (value, element) {
        return /^[0-9]+$/.test(value);
    })

})

function validateForm() {
    $data = $('#date_of_birth').val();
    $dob = new Date($data);
    $today = new Date();

    $res = $today - $dob;
    if ($dob > $today) {
        $("#date_of_birth").addClass("is-invalid");
        $("#date_of_birth").after(
            '<span class="invalid-feedback" role="alert">DOB is in future</span>'
        );
    }

}

$(document).ready(function () {
    $("#togglePassword").click(function () {
        var passwordField = $("#password");
        var icon = $(this);

        // Toggle the password field type between text and password
        passwordField.attr('type', passwordField.attr('type') === 'password' ? 'text' : 'password');

        // Toggle Font Awesome icons
        icon.toggleClass('fa-eye fa-eye-slash');
    });
});

$(document).ready(function () {
    $("#toggle_password").click(function () {
        var passwordField = $("#confirm_password");
        var icon = $(this);

        // Toggle the password field type between text and password
        passwordField.attr('type', passwordField.attr('type') === 'password' ? 'text' : 'password');

        // Toggle Font Awesome icons
        icon.toggleClass('fa-eye fa-eye-slash');
    });
});


