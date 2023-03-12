@extends('layouts/contentLayoutMaster')

@section('title', 'My Account')

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
        <!-- profile -->
        <div class="card">
            <div class="card-header border-bottom">
                <div class="col-6">

                </div>
            </div>
            <div class="card-body py-2 my-25">
                <!--/ header section -->
                <!-- form -->
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
                <div class="row">
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="accountFirstName">Panel Number</label>
                        <input type="text" class="form-control" readonly id="name" name="name"
                            value="{{ $user_profile_data->name }}" data-msg="Please enter first name" />
                    </div>
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="accountEmail">Email Address</label>
                        <input type="email" class="form-control" required readonly id="email" name="email"
                            value="{{ $user_profile_data->email }}" />
                    </div>
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="accountPhoneNumber">Phone Number</label>
                        <input type="text" class="form-control account-number-mask" id="phone" name="phone"
                            value="{{ $user_profile_data->phone_number }}" />
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="accountPhoneNumber">Created At</label>
                        <input type="text" class="form-control account-number-mask" id="phone" name="phone"
                            value="{{ $user_profile_data->created_at }}" />
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" id="update_profile" class="btn btn-primary mt-1 me-1">Update
                        Profile</button>
                </div>
            </div>

            <!--/ form -->
        </div>
    </div>
    {{-- deactivate account --}}
    <div class="card">
        {{-- <div class="card-header border-bottom">
            <h4 class="card-title">Deactivate Account</h4>
        </div> --}}
        <div class="card-body py-2 my-25">
            <div class="alert alert-warning">
                <div class="alert-body fw-normal">
                    Click the button below to change your password
                </div>
            </div>

            <div class="row">
                <input type="hidden" name="_token" id="csrf1" value="{{Session::token()}}">
                <div class="col-12 col-sm-4 mb-1">
                    <button type="submit" class="btn btn-info deactivate-account mt-1" data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal">Change Password</button>
                </div>
            </div>
        </div>
    </div>
    <!--/ profile
  </div>
</div>
@include('panelprofile::profile/_partials/_modals/change-password')
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

    <script src="{{ asset('js/scripts/pages/user-profile.js') }}"></script>

    @endsection