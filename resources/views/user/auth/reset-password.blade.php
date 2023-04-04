@extends('layouts/fullLayoutMaster')

@section('title', 'Recover Password')

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
        <!-- two steps verification basic-->
        <div class="card mb-0">
            <div class="card-body">
                <a href="#" class="brand-logo">
                    
                    <h2 class="brand-text text-primary ms-1">Lightline Research</h2>
                </a>

                <h2 class="card-title fw-bolder mb-1">Set New Password</h2>
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                @if ($link_correct == 'Yes')
                <input type="hidden" id="token" name="token" value="{{$token}}">
                @endif
                <div class="mb-1">
                    <label class="form-label" for="login-email">Password</label>
                    <input class="form-control" id="password" type="password" name="password" min="8" required
                        placeholder="Enter new password" aria-describedby="login-email" autofocus="" tabindex="1" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="login-email">Re-enter password</label>
                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required
                        placeholder="Re-enter new password" aria-describedby="login-email" autofocus="" tabindex="1" />
                </div>
                <button type="submit" class="btn btn-primary w-100" id="reset_pass_btn" tabindex="4">Reset
                    Password
                </button>
            </div>
        </div>
        <!-- /two steps verification basic -->
    </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>

<script>
    $(document).ready(function() {

      $('#reset_pass_btn').on('click', function() {
       
          var password = $('#password').val();
          var password_confirmation = $('#password_confirmation').val();
          var token = $('#token').val();
              $.ajax({
                  url: "/reset-password-process",
                  type: "POST",
                  data: {
                      _token: $("#csrf").val(),
                      type: 1,
                      password: password,
                      password_confirmation: password_confirmation,
                      token: token
                  },
                  cache: false,
                  success: function(response) {
                      var response = JSON.parse(response);
                      var isRtl = $('html').attr('data-textdirection') === 'rtl';
                     
                      if (response.statusCode == 200) {
                         toastr['success'](response.message, "Reset Password", {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                        });
                      window.location = "/auth/user/login";
                      } else if (response.statusCode == 201) {
                        toastr['error'](response.message, "Reset Password", {
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
</script>
@endsection