@extends('layouts/fullLayoutMaster')

@section('title', 'Forgot Password')

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

                <h2 class="card-title fw-bolder mb-1">Recover Password</h2>
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                <h6>Email</h6>
                <div class="auth-input-wrapper d-flex align-items-center justify-content-between">
                    <input type="email" required id="email" class="form-control mb-1" autofocus="" />
                </div>
                <button type="submit" class="btn btn-primary w-100" id="send_pass_reset_btn" tabindex="4">Recover
                    Password
                </button>
                <p class="text-center mt-2">
                    <span></span>
                    <a href="{{url('/auth/user/login')}}"><span>&nbsp;Click here to login</span></a>
                </p>
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

      $('#send_pass_reset_btn').on('click', function() {
       
          var email = $('#email').val();
              $.ajax({
                  url: "/auth/user/sendPasswordResetEmail",
                  type: "POST",
                  data: {
                      _token: $("#csrf").val(),
                      type: 1,
                      email: email
                  },
                  cache: false,
                  success: function(response) {
                      console.log(response);
                      var response = JSON.parse(response);
                      var isRtl = $('html').attr('data-textdirection') === 'rtl';
                     
                      if (response.statusCode == 200) {
                         
                      window.location = "/auth/user/login";
                      } else if (response.statusCode == 201) {
                        toastr['error'](response.message, "Recover Password", {
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