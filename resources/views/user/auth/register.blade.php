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

<style>
  #myForm label.error {
    color: red !important;
    font-size: 0.8em !important;
    margin-top: 5px !important;
  }
</style>

@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    <a class="brand-logo" href="#">

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

        <form id="myForm">
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <div class="mb-1">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="name" placeholder="Enter first and last name" />
          </div>

          <div class="mb-1">
            <label for="email">Email Address</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email address" />
          </div>

          <div class="mb-1">
            <label for="phone">Phone Number</label>
            <input id="phone" name="phone" type="tel" class="form-control intl-tel-input">
            <input id="completePhone" type="hidden" name="completePhone">
            <input id="countryCode" type="hidden" id="countryCode">
          </div>

          <div class="mb-1">
            <label for="password">Password</label>
            <input type="password" class="form-control form-control-merge" id="password" name="password"
              placeholder="Enter your password" />
          </div>

          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" id="terms" name="terms" type="checkbox" tabindex="4" />
              <label for="terms">I agree to<a href="#">&nbsp;privacy policy &
                  terms</a></label>
            </div>
          </div>
          <button class="btn btn-primary w-100" id="auth_register" tabindex="5">Create Account</button>
        </form>

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

{{-- New code --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
{{-- New code --}}

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
<script src="{{ asset(mix('vendors/js/intl-tel-input/intlTelInput.js')) }}"></script>
<script src="{{ asset('js/scripts/register.js') }}"></script>
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
    document.getElementById('completePhone').value = iti.getNumber();
    document.getElementById('countryCode').value = countryCode;

  };

  // listen to "keyup", but also "change" to update when the user selects a country
  input.addEventListener('change', handleChange);
  input.addEventListener('keyup', handleChange);
</script>

{{-- <script>
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
            window.location = "/auth/user/verify?a2fc0b91fe81da0904a2dd407abca5879ca55839f3a4ebcf6f192814ad220bb4cf358d1adbf51199ee7f64d41f8d18be=" + _id;
          } else if (response.statusCode == 201) {

          }

        }
      });
    });
  });
</script> --}}
@endsection