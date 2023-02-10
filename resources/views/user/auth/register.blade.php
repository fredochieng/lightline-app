@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Create Account')

@section('page-style')
{{-- Page Css files --}}
{{--
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}"> --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
<link rel="stylesheet" href="{{ asset('vendors/css/intl-tel-input/intlTelInput.css') }}">
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    <a class="brand-logo" href="#">
      <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
        <defs>
          <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
            <stop stop-color="#000000" offset="0%"></stop>
            <stop stop-color="#FFFFFF" offset="100%"></stop>
          </lineargradient>
          <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
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
                points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
              <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
              <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
            </g>
          </g>
        </g>
      </svg>
      <h2 class="brand-text text-primary ms-1">Lightline Research</h2>
    </a>
    <!-- /Brand logo-->

    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
        <img class="img-fluid" src="{{asset('images/pages/register-v2-dark.svg')}}" alt="Register V2" />
        @else
        <img class="img-fluid" src="{{asset('images/pages/register-v2.svg')}}" alt="Register V2" />
        @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Register-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h4 class="card-title fw-bold mb-1">Sign up to start the adventure</h4>
        {{-- <p class="card-text mb-2">Make your app management easy and fun!</p> --}}

        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
        <div class="mb-1">
          <label for="register-username" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullname" name="name" placeholder="Enter first and last name" />
        </div>

        <div class="mb-1">
          <label class="form-label" for="register-email">Email Address</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Enter email address" />
        </div>

        <div class="mb-1">
          <label class="form-label" for="register-password">Phone Number</label>
          <input id="phone" type="tel" class="form-control intl-tel-input">
          <input id="completePhone" type="hidden" id="completePhone">
          <input id="countryCode" type="hidden" id="countryCode">
        </div>

        <div class="mb-1">
          <label class="form-label" for="register-email">Password</label>
          <input type="password" class="form-control form-control-merge" id="password" name="password"
            placeholder="Enter your password" />
        </div>

        <div class="mb-1">
          <div class="form-check">
            <input class="form-check-input" id="register-privacy-policy" type="checkbox" tabindex="4" />
            <label class="form-check-label" for="register-privacy-policy">I agree to<a href="#">&nbsp;privacy policy &
                terms</a></label>
          </div>
        </div>
        <button class="btn btn-primary w-100" id="auth_register" tabindex="5">Create Account</button>

        <p class="text-center mt-2">
          <span>Already have an account with us?</span>
          @if (Route::has('login'))
          <a href="{{ route('login') }}">
            <span>Log In</span>
          </a>
          @endif
        </p>
      </div>
    </div>
    <!-- /Register-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script> --}}
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
<script src="{{ asset(mix('vendors/js/intl-tel-input/intlTelInput.js')) }}"></script>

<script>
  var input = document.querySelector("#phone");
  output = document.querySelector("#output");
  var iti = window.intlTelInput(input, {
    nationalMode: true,
    separateDialCode: true,
    onlyCountries: ["ke", "ug", "tz"],
    preferredCountries: ["ke"],
    utilsScript: "{{ asset(mix('vendors/js/intl-tel-input/utils.js')) }}" 
    // any initialisation options go here
  });

  var handleChange = function() {
  var text = (iti.isValidNumber()) ? iti.getNumber() : iti.getNumber();
  var textNode = document.createTextNode(text);

  // Get selected country\  
  var countryData = iti.getSelectedCountryData();
  var countryCode = countryData['iso2'];

  // set input variables to input
  document.getElementById('completePhone').value= iti.getNumber();
  document.getElementById('countryCode').value= countryCode;
  
};

// listen to "keyup", but also "change" to update when the user selects a country
input.addEventListener('change', handleChange);
input.addEventListener('keyup', handleChange);
</script>

<script>
  $(document).ready(function() {

      $('#auth_register').on('click', function() {
          var name = $('#fullname').val();
          var email = $('#email').val();
          var phone = $('#completePhone').val();
          var country_code = $('#countryCode').val();
          var password = $('#password').val();
          // Post request using Ajax
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
                  success: function(response) {
                      //console.log(response);
                      var response = JSON.parse(response);
                      var isRtl = $('html').attr('data-textdirection') === 'rtl';
                     // alert(response.statusCode);
                      if (response.statusCode == 200) {
                          _id = response.bba9f6361764d423317d202402d57190;
                          _uel = response.f90bddc85fb0161fd0c8b1928c58ea04;
                          window.location = "/auth/user/verify?a2fc0b91fe81da0904a2dd407abca5879ca55839f3a4ebcf6f192814ad220bb4cf358d1adbf51199ee7f64d41f8d18be="+_id;
                      } else if (response.statusCode == 201) {
                         
                      }

                  }
              });
      });
  });
</script>
@endsection