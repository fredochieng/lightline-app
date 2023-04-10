$(document).ready(function () {
    /** Update user profile */
    $('#update_profile').on('click', function () {
        var dob = $('#fp_default').val();
        var gender = $('#gender').val();
        var user_id = $('#user_id').val();
        var education_level_id = $('#education_level_id').val();
        var marital_status_id = $('#marital_status_id').val();
        //var race_id = $('#race_id').val();

        // Post request using Ajax
        $.ajax({
            url: "/user/profile/update",
            type: "POST",
            data: {
                _token: $("#csrf").val(),
                type: 1,
                l9ky0xwifr3sqtzv: user_id,
                dob: dob,
                gender: gender,
                education_level_id: education_level_id,
                marital_status_id: marital_status_id,
                //race_id:race_id
            },
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                var isRtl = $('html').attr('data-textdirection') === 'rtl';
                if (response.statusCode == 200) {
                    // Show toastr notification
                    toastr['success'](response.message, 'Profile Update', {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                    });

                    location.reload();

                } else if (response.statusCode == 201) {
                    toastr['error'](response.message, 'Profile Update', {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                    });
                }

            }
        });
    });

    $('#changePassBtn').on('click', function () {
        var current_pass = $('#current_pass').val();
        var new_pass = $('#new_pass').val();
        var confirm_pass = $('#confirm_pass').val();
        var user_id = $('#user_id').val();

        // Post request using Ajax
        $.ajax({
            url: "/user/changePassword",
            type: "POST",
            data: {
                _token: $("#csrf").val(),
                type: 1,
                l9ky0xwifr3sqtzv: user_id,
                current_pass: current_pass,
                new_pass: new_pass,
                confirm_pass: confirm_pass
            },
            cache: false,
            success: function (response) {
                var response = JSON.parse(response);
                var isRtl = $('html').attr('data-textdirection') === 'rtl';
                if (response.statusCode == 200) {
                    // Show toastr notification
                    toastr['success'](response.message, 'Password Change', {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                    });

                    location.reload();

                } else if (response.statusCode == 201) {
                    toastr['error'](response.message, 'Password Change', {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                    });
                }

            }
        });
    });
});