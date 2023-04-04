@extends('layouts/contentLayoutMaster')

@section('title', 'Upload Points File')

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
           <form class="form-horizontal" method="POST" action="{{ route('points.upload.file') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                {{-- <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}"> --}}
                <div class="row">
                    <div class="col-6 col-sm-6 mb-1">
                        <label for="currency" class="form-label">Transaction Purpose</label>
                        <select id="purpose" name="purpose" class="select2 form-select" required>
                            <option value="">Select transaction purpose</option>
                            <option value="Survey">Survey</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                   <div class="col-6 col-sm-6 mb-1">
                        <label for="formFile" class="form-label">Select points File</label>
                        <input class="form-control" type="file" name="csv_file" id="csv_file">
                    </div>

                </div>
                <div class="col-12">
                    <button type="submit" id="update_profiles" class="btn btn-primary mt-1 me-1">Upload File
                    </button>
                </div>
            </div>

        </form>
        </div>
    </div>

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

<script src="{{ asset('js/scripts/pages/user-profile.js') }}"></script>

@endsection