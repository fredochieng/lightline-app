@extends('layouts/fullLayoutMaster')

@section('title', 'Verify Account')

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

                <h2 class="card-title fw-bolder mb-1">You're almost there! Activate account</h2>
                <p class="card-text mb-75">
                    We sent a verification code to your email. Enter the code from the email in the field below.
                </p>

                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                <input type="hidden" name="c3f5ffa0e4b13671f15334aa066d20b9" id="c3f5ffa0e4b13671f15334aa066d20b9"
                    value="{{ $c3f5ffa0e4b13671f15334aa066d20b9 }}">
                <h6>Enter your 6 digit verification code</h6>
                <div class="auth-input-wrapper d-flex align-items-center justify-content-between">
                    <input type="text" required id="d1"
                        class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" maxlength="1"
                        autofocus="" />

                    <input type="text" required id="d2"
                        class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" maxlength="1" />

                    <input type="text" required id="d3"
                        class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" maxlength="1" />

                    <input type="text" required id="d4"
                        class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" maxlength="1" />

                    <input type="text" required id="d5"
                        class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" maxlength="1" />

                    <input type="text" required id="d6"
                        class="form-control auth-input height-50 text-center numeral-mask mx-25 mb-1" maxlength="1" />
                </div>
                <button type="submit" class="btn btn-primary w-100" id="verify_account" tabindex="4">Verify
                    Account</button>

                <p class="text-center mt-2">
                    <span>Didn’t get the code?</span><a href="Javascript:void(0)"><span>&nbsp;Resend verification
                            code</span></a>
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
<script src="{{asset(mix('js/scripts/pages/auth-two-steps.js'))}}"></script>
<script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>

<script>
    $(document).ready(function() {

      $('#verify_account').on('click', function() {
       
          var id = $('#c3f5ffa0e4b13671f15334aa066d20b9').val();
          var code  = $('#d1').val()+$('#d2').val()+$('#d3').val()+$('#d4').val()+$('#d5').val()+$('#d6').val();
              $.ajax({
                  url: "/auth/user/verify-account",
                  type: "POST",
                  data: {
                      _token: $("#csrf").val(),
                      type: 1,
                      fc0b91fe81da0904a2dd407abc: id,
                      f6f192814ad220bb4cf358d1ad: code
                  },
                  cache: false,
                  success: function(response) {
                      console.log(response);
                      var response = JSON.parse(response);
                      var isRtl = $('html').attr('data-textdirection') === 'rtl';
                     
                      if (response.statusCode == 200) {
                         
                      window.location = "/auth/user/login";
                      } else if (response.statusCode == 201) {
                        toastr['error'](response.message, {
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