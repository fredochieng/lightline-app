@extends('layouts/contentLayoutMaster')

@section('title', 'Form Validation')

@section('vendor-style')
{{-- Vendor Css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
<!-- Validation -->
<section class="bs-validation">
  <div class="row">
    <!-- Bootstrap Validation -->
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Bootstrap Validation</h4>
        </div>
        <div class="card-body">
          <form class="needs-validation" novalidate>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Name</label>

              <input type="text" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name"
                aria-describedby="basic-addon-name" required />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter your name.</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-default-email1">Email</label>
              <input type="email" id="basic-default-email1" class="form-control" placeholder="john.doe@email.com"
                aria-label="john.doe@email.com" required />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter a valid email</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-default-password1">Password</label>
              <input type="password" id="basic-default-password1" class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter your password.</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="bsDob">DOB</label>
              <input type="text" class="form-control picker" name="dob" id="bsDob" required />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter your date of birth.</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="select-country1">Country</label>
              <select class="form-select" id="select-country1" required>
                <option value="">Select Country</option>
                <option value="usa">USA</option>
                <option value="uk">UK</option>
                <option value="france">France</option>
                <option value="australia">Australia</option>
                <option value="spain">Spain</option>
              </select>
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please select your country</div>
            </div>
            <div class="mb-1">
              <label for="customFile1" class="form-label">Profile pic</label>
              <input class="form-control" type="file" id="customFile1" required />
            </div>
            <div class="mb-1">
              <label class="form-label" class="d-block">Gender</label>
              <div class="form-check my-50">
                <input type="radio" id="validationRadio3" name="validationRadioBootstrap" class="form-check-input"
                  required />
                <label class="form-check-label" for="validationRadio3">Male</label>
              </div>
              <div class="form-check">
                <input type="radio" id="validationRadio4" name="validationRadioBootstrap" class="form-check-input"
                  required />
                <label class="form-check-label" for="validationRadio4">Female</label>
              </div>
            </div>
            <div class="mb-1">
              <label for="validationCustomUsername" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" class="form-control" id="validationCustomUsername"
                  aria-describedby="inputGroupPrepend" required />
                <div class="invalid-feedback">Please choose a username.</div>
              </div>
            </div>
            <div class="mb-1">
              <label class="d-block form-label" for="validationBioBootstrap">Bio</label>
              <textarea class="form-control" id="validationBioBootstrap" name="validationBioBootstrap" rows="3"
                required></textarea>
            </div>
            <div class="mb-1">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="validationCheckBootstrap" required />
                <label class="form-check-label" for="validationCheckBootstrap">Agree to our terms and conditions</label>
                <div class="invalid-feedback">You must agree before submitting.</div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <!-- /Bootstrap Validation -->

    <!-- jQuery Validation -->
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">jQuery Validation</h4>
        </div>
        <div class="card-body">
          <form id="jquery-val-form" method="post">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <div class="mb-1">
              <label for="register-username" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="basic-default-name" name="basic-default-name" {{--
                id="fullname" name="name" --}} placeholder="Enter first and last name" />
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
                <label class="form-check-label" for="register-privacy-policy">I agree to<a href="#">&nbsp;privacy policy
                    &
                    terms</a></label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" id="auth_register" name="submit"
              value="Submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <!-- /jQuery Validation -->
  </div>
</section>
<!-- /Validation -->
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>

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