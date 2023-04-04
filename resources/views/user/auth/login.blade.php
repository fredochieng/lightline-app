@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Sign In')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

@endsection

@section('content')
<div class="auth-wrapper auth-cover">
    <div class="auth-inner row m-0">
        <!-- Brand logo-->
        <a class="brand-logo" href="#">
            {{-- <img class="img-fluid" style="width:100%; height:100%" src="{{asset('images/logo/logo.png')}}"
                alt="Login V2" /> --}}
            <h2 class="brand-text text-primary ms-1">Lightline Research</h2>
        </a>
        <!-- /Brand logo-->

        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                @if($configData['theme'] === 'dark')
                <img class="img-fluid" src="{{asset('images/pages/login-v2-dark.svg')}}" alt="Login V2" />
                @else
                <img class="img-fluid" src="{{asset('images/pages/login-v2.svg')}}" alt="Login V2" />
                @endif
            </div>
        </div>
        <!-- /Left Text-->

        <!-- Login-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                <h2 class="card-title fw-bold mb-1">Welcome to Lightline Online👋</h2>
                <form id="loginForm">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <div class="mb-1">
                        <label class="form-label" for="login-email">Email Address</label>
                        <input class="form-control" id="email" type="text" name="email"
                            placeholder="Enter your email address" aria-describedby="login-email" autofocus=""
                            tabindex="1" />
                    </div>
                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="login-password">Password</label>
                            <a href="{{url("auth/forgot-password")}}">
                                <small>Forgot Password?</small>
                            </a>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="password" type="password" name="password"
                                placeholder="Enter your password" tabindex="2" />
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-check">
                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                            <label class="form-check-label" for="remember-me"> Remember Me</label>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" id="user_login_btn" tabindex="4">Login</button>
                </form>
                <p class="text-center mt-2">
                    <span>Don't have an account?</span>
                    <a href="{{url('/auth/user/register')}}"><span>&nbsp;Create an account</span></a>
                </p>
            </div>
        </div>
        <!-- /Login-->
    </div>
</div>
@endsection

@section('vendor-script')
{{-- New code --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
{{-- New code --}}

{{-- <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script> --}}
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
<script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>

<script>
    $(document).ready(function () {
    $('#loginForm').submit(function (event) {
        event.preventDefault(); // prevent default form submit behavior

        // initialize jQuery Validate plugin with custom error messages
        $('#loginForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
               
                password: {
                    required: true
                }
            },
            messages: {
                
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address",
                },
                
                password: {
                    required: "Please enter a password",
                },
            }
        });

        // perform form validation
        if ($('#loginForm').valid()) {
            // submit the form data via AJAX
             var email = $('#email').val();
             var password = $('#password').val();
              $.ajax({
                  url: "/auth/user/authenticate",
                  type: "POST",
                  data: {
                      _token: $("#csrf").val(),
                      type: 1,
                      email: email,
                      password: password
                  },
                  cache: false,
                  success: function(response) {
                     // console.log(response);
                      var response = JSON.parse(response);
                      var isRtl = $('html').attr('data-textdirection') === 'rtl';
                     // alert(response.statusCode);
                      if (response.statusCode == 200) {
                         
                      window.location = response.redirect_url;
                      } else if (response.statusCode == 201) {
                          toastr['error'](response.message, 'Login Feedback', {
                          closeButton: true,
                          tapToDismiss: false,
                          progressBar: true,
                          rtl: isRtl
                      });
                      }

                  }
              });
        } else {
            // $('#auth_register').prop('disabled', true);
        }
    });
});
</script>
@endsection