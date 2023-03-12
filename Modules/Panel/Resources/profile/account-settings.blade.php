@extends('layouts/contentLayoutMaster')

@section('title', 'Account')

@section('vendor-style')
<!-- vendor css files -->
<link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel='stylesheet' href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
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
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-billing')}}">
          <i data-feather="bookmark" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Billings &amp; Plans</span>
        </a>
      </li>
      <!-- notification -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-notifications')}}">
          <i data-feather="bell" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Notifications</span>
        </a>
      </li>
      <!-- connection -->
      <li class="nav-item">
        <a class="nav-link" href="{{asset('page/account-settings-connections')}}">
          <i data-feather="link" class="font-medium-3 me-50"></i>
          <span class="fw-bold">Connections</span>
        </a>
      </li>
    </ul>

    <!-- profile -->
    <div class="card">
      <div class="card-header border-bottom">
        <h4 class="card-title">Profile Details</h4>
      </div>
      <div class="card-body py-2 my-25">
        <!--/ header section -->

        <!-- form -->
        <form class="validate-form mt-1 pt-40">
          <div class="row">
            <div class="col-12 col-sm-6 mb-1">
              <label class="form-label" for="accountFirstName">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="John" data-msg="Please enter first name" />
            </div>
            <div class="col-12 col-sm-6 mb-1">
              <label class="form-label" for="accountEmail">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" value="johndoe@gmail.com" />
            </div>
            <div class="col-12 col-sm-6 mb-1">
              <label class="form-label" for="accountPhoneNumber">Phone Number</label>
              <input type="text" class="form-control account-number-mask" id="phone" name="phone" value="" />
            </div>
            <div class="col-12 col-sm-6 mb-1">
              <label class="form-label" for="accountPhoneNumber">Date of Birth</label>
              <input type="text" class="form-control account-number-mask" id="dob" name="dob" value="" />
            </div>
            <div class="col-12 col-sm-6 mb-1">
              <label class="form-label" for="country">Country</label>
              <select id="country" class="select2 form-select">
                <option value="">Select Country</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
            <div class="col-12 col-sm-6 mb-1">
              <label for="language" class="form-label">Gender</label>
              <select id="language" class="select2 form-select">
                <option value="">Select Gender</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div>
            <div class="col-12 col-sm-6 mb-1">
              <label for="timeZones" class="form-label">Timezone</label>
              <select id="timeZones" class="select2 form-select">
                <option value="">Select Time Zone</option>
                <option value="-12">
                  (GMT-12:00) International Date Line West
                </option>
                <option value="-11">
                  (GMT-11:00) Midway Island, Samoa
                </option>
                <option value="-10">
                  (GMT-10:00) Hawaii
                </option>
              </select>
            </div>
            <div class="col-12 col-sm-6 mb-1">
              <label for="currency" class="form-label">Currency</label>
              <select id="currency" class="select2 form-select">
                <option value="">Select Currency</option>
                <option value="usd">USD</option>
                <option value="euro">Euro</option>
                <option value="pound">Pound</option>
                <option value="bitcoin">Bitcoin</option>
              </select>
            </div>
            <div class="col-12">
              <button type="submit" id="update_profile" class="btn btn-primary mt-1 me-1">Update Profilke</button>
              <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
            </div>
          </div>
        </form>
        <!--/ form -->
      </div>
    </div>
    <!-- deactivate account  -->
    {{-- <div class="card">
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
    </div> --}}
    <!--/ profile -->
  </div>
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/page-account-settings-account.js')) }}"></script>
@endsection