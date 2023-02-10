@extends('layouts/contentLayoutMaster')

@section('title', 'Account')

@section('vendor-style')
<!-- vendor css files -->
<link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
{{--
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}"> --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <ul class="nav nav-pills mb-2">
      <!-- Account -->
      <li class="nav-item">
        <a class="nav-link active" href="{{asset('page/account-settings-account')}}">
          <i data-feather="user" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Account</span>
        </a>
      </li>
      <!-- security -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('user/profile1')}}">
          <i data-feather="lock" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Security</span>
        </a>
      </li>
      <!-- billing and plans -->
    </ul>

    <!-- profile -->
    <div class="card">
      <div class="card-header border-bottom">
        <div class="col-6">
          <div class="progress-wrapper">
            <div id="example-caption-4">Profile Completeness&hellip; {{ $profile_complete_per }}%</div>
            @if ($profile_complete_per < 50) <div class="progress progress-bar-danger">
              @elseif($profile_complete_per > 50 && $profile_complete_per< 80) <div
                class="progress progress-bar-primary">
                @else
                <div class="progress progress-bar-success">
                  @endif
                  <div class="progress-bar" role="progressbar" aria-valuenow="{{ $profile_complete_per }}"
                    aria-valuemin="{{ $profile_complete_per}}" aria-valuemax="100"
                    style="width: {{ $profile_complete_per }}%" aria-describedby="example-caption-4"></div>
                </div>
          </div>
        </div>
      </div>
      <div class="card-body py-2 my-25">
        <!--/ header section -->
        <!-- form -->
        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
        <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
        <div class="row">
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="accountFirstName">Panel Number</label>
            <input type="text" class="form-control" readonly id="name" name="name"
              value="{{ $user_profile_data->panel_no }}" data-msg="Please enter first name" />
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="accountFirstName">Name</label>
            <input type="text" class="form-control" readonly id="name" name="name"
              value="{{ $user_profile_data->name }}" data-msg="Please enter first name" />
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="accountEmail">Email Address</label>
            <input type="email" class="form-control" required readonly id="email" name="email"
              value="{{ $user_profile_data->email }}" />
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="accountPhoneNumber">Phone Number</label>
            <input type="text" class="form-control account-number-mask" id="phone" name="phone"
              value="{{ $user_profile_data->phone_number }}" />
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="accountPhoneNumber">Date of Birth</label>
            @if( $user_profile_data->dob == NULL)
            <input type="text" id="fp_default" required class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
            @else
            <input type="text" id="fp_default" required class="form-control" readonly
              value="{{ $user_profile_data->dob }}" placeholder="YYYY-MM-DD" />
            @endif
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="country">Country</label>
            <select id="country" required class="select2 form-select">
              <option value="{{ $user_profile_data->country_code }}">{{ $user_profile_data->country_name }}</option>
              @foreach($countries as $country)
              <option value="{{ $country->country_code }}">{{ $country->country_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label for="language" class="form-label">Gender</label>
            @if($user_profile_data->gender == NULL)
            <select id="gender" required required class="select2 form-select">
              <option value="">Select gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
            @else
            <input type="text" id="gender" readonly class="form-control" value="{{ $user_profile_data->gender }}" />
            @endif
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="country">Marital Status</label>
            <select id="marital_status_id" required class="select2 form-select" required>
              <option value="{{ $user_profile_data->marital_status_id }}">{{ $user_profile_data->marital_status }}
              </option>
              @foreach($marital_status as $mar_status)
              <option value="{{ $mar_status->marital_status_id }}">{{ $mar_status->marital_status }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="country">Education Level</label>
            <select id="education_level_id" required class="select2 form-select" required>
              <option value="{{ $user_profile_data->education_level_id }}">{{ $user_profile_data->education_level }}
              </option>
              @foreach($education_levels as $education_level)
              <option value="{{ $education_level->education_level_id }}">{{ $education_level->education_level }}
              </option>
              @endforeach
            </select>
          </div>
          {{-- <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="country">Race</label>
            <select id="race_id" required class="select2 form-select" required>
              <option value="{{ $user_profile_data->race_id }}">{{ $user_profile_data->race }}
              </option>
              @foreach($races as $race)
              <option value="{{ $race->race_id }}">{{ $race->race }}
              </option>
              @endforeach
            </select>
          </div> --}}

          <div class="col-12">
            <button type="submit" id="update_profile" class="btn btn-primary mt-1 me-1">Update Profile</button>
          </div>
        </div>

        <!--/ form -->
      </div>
    </div>
    <!-- deactivate account  -->
    <div class="card">
      <div class="card-header border-bottom">
        <h4 class="card-title">Deactivate Account</h4>
      </div>
      <div class="card-body py-2 my-25">
        <div class="alert alert-warning">
          <h4 class="alert-heading">Are you sure you want to deactivate your account?</h4>
          <div class="alert-body fw-normal">
            Once you deactivate your account, there is no going back. Please be certain.
          </div>
        </div>

        <form id="formAccountDeactivation" class="validate-form" onsubmit="return false">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation"
              data-msg="Please confirm you want to delete account" />
            <label class="form-check-label font-small-3" for="accountActivation">
              I confirm my account deactivation
            </label>
          </div>
          <div>
            <button type="submit" class="btn btn-danger deactivate-account mt-1">Deactivate Account</button>
          </div>
        </form>
      </div>
    </div>
    <!--/ profile -->
  </div>
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/page-account-settings-account.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>

<script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>

<script>
  $(document).ready(function() {
      $('#update_profile').on('click', function() {
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
                      marital_status_id:marital_status_id,
                      //race_id:race_id
                  },
                  cache: false,
                  success: function(response) {
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
  });
</script>
@endsection