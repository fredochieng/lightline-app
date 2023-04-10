$(document).ready(function () {
    $('#myForm').submit(function (event) {
        event.preventDefault(); // prevent default form submit behavior

        // initialize jQuery Validate plugin with custom error messages
        $('#myForm').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "/check-email",
                        type: "post",
                        data: {
                            email: function () {
                                return $("#email").val();
                            },
                            _token: $("#csrf").val()
                        }
                    }
                },
                phone: {
                    required: true,
                    remote: {
                        url: "/check-phone",
                        type: "post",
                        data: {
                            phone: function () {
                                return $("#completePhone").val();
                            },
                            _token: $("#csrf").val()
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                name: {
                    required: "Please enter your name"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address",
                    remote: "This email has already been registered."
                },
                phone: {
                    required: "Please enter your phone number",
                    remote: "This phone has already been registered."
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                terms: {
                    required: 'Please accept the terms and conditions'
                }
            }
        });

        // perform form validation
        if ($('#myForm').valid()) {
            // submit the form data via AJAX
           // $('#auth_register').prop('disabled', false);
            var name = $('#fullname').val();
            var email = $('#email').val();
            var phone = $('#completePhone').val();
            var country_code = $('#countryCode').val();
            var password = $('#password').val();
            $.ajax({
                url: "/auth/user/process-registration",
                type: "POST",
                data: {
                    _token: $("#csrf").val(),
                    type: 1,
                    name: name,
                    email: email,
                    phone: phone,
                    country_code: country_code,
                    password: password
                },
                cache: false,
                success: function (response) {
                    //console.log(response);
                    var response = JSON.parse(response);
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    // alert(response.statusCode);
                    if (response.statusCode == 200) {
                        _id = response.bba9f6361764d423317d202402d57190;
                        _uel = response.f90bddc85fb0161fd0c8b1928c58ea04;
                        window.location = "/auth/user/verify?a2fc0b91fe81da0904a2dd407abca5879ca55839f3a4ebcf6f192814ad220bb4cf358d1adbf51199ee7f64d41f8d18be=" + _id;
                    } else if (response.statusCode == 201) {

                    }

                }
            });
        } else {
            // $('#auth_register').prop('disabled', true);
        }
    });
});
