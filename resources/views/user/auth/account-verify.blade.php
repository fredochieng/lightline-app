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
                    <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
                        <defs>
                            <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                <stop stop-color="#000000" offset="0%"></stop>
                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                            </lineargradient>
                            <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                y2="100%">
                                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                            </lineargradient>
                        </defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                <g id="Group" transform="translate(400.000000, 178.000000)">
                                    <path class="text-primary" id="Path"
                                        d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                        style="fill: currentColor"></path>
                                    <path id="Path1"
                                        d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                        fill="url(#linearGradient-1)" opacity="0.2"></path>
                                    <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                        points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                    </polygon>
                                    <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                        points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                    </polygon>
                                    <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                        points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                </g>
                            </g>
                        </g>
                    </svg>
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