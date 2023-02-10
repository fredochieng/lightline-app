@extends('layouts/contentLayoutMaster')

@section('title', 'Panel View - Account')

@section('vendor-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection

@section('content')
<section class="app-user-view-account">
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-5 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <div class="user-info text-center">
                                <h4>{{ $panel_details->name }}</h4>
                                @if ($panel_details->status == 0)
                                <span class="badge bg-light-warning">Pending</span>
                                @else
                                <span class="badge bg-light-success">Active</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around my-2 pt-75">
                        <div class="d-flex align-items-start me-2">
                            <span class="badge bg-light-primary p-75 rounded">
                                <i data-feather="check" class="font-medium-2"></i>
                            </span>
                            <div class="ms-75">
                                <h4 class="mb-0">{{ $panel_points->points_earned }}</h4>
                                <small>Points Earned</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start me-2">
                            <span class="badge bg-light-primary p-75 rounded">
                                <i data-feather="check" class="font-medium-2"></i>
                            </span>
                            <div class="ms-75">
                                <h4 class="mb-0">{{ $panel_points->points_redeemed }}</h4>
                                <small>Points Redeemed</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <span class="badge bg-light-primary p-75 rounded">
                                <i data-feather="briefcase" class="font-medium-2"></i>
                            </span>
                            <div class="ms-75">
                                <h4 class="mb-0">{{ $panel_points->points_balance }}</h4>
                                <small>Points Balance</small>
                            </div>
                        </div>
                    </div>
                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Panel Number: #{{ $panel_details->panel_no }}</h4>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-75">
                                <span class="fw-bolder me-25">Email:</span>
                                <span>{{ $panel_details->email }}</span>
                            </li>
                            <li class="mb-75">
                                <span class="fw-bolder me-25">Phone:</span>
                                <span>{{ $panel_details->phone_number }}</span>
                            </li>
                            <li class="mb-75">
                                <span class="fw-bolder me-25">Date of Birth:</span>
                               <span>{{ $panel_details->dob }}</span>
                            </li>
                            <li class="mb-75">
                                <span class="fw-bolder me-25">Gender:</span>
                                <span>{{ $panel_details->gender }}</span>
                            </li>
                            <li class="mb-75">
                                <span class="fw-bolder me-25">Country:</span>
                                <span>{{ $panel_details->country_name }}</span>
                            </li>
                            <li class="mb-75">
                                <span class="fw-bolder me-25">Marital Status:</span>
                                <span>{{ $panel_details->marital_status }}</span>
                            </li>
                            <li class="mb-75">
                                <span class="fw-bolder me-25">Education Level:</span>
                                <span>{{ $panel_details->education_level }}</span>
                            </li>
                            <li class="mb-75">
                                <span class="fw-bolder me-25">Joined On:</span>
                                <span>{{ $panel_details->registration_timestamp }}</span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-left pt-2">
                            <a href="javascript:;" class="btn btn-danger suspend-user">Deactivate Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /User Card -->
            <!-- Plan Card -->
            {{-- <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <span class="badge bg-light-primary">Standard</span>
                        <div class="d-flex justify-content-center">
                            <sup class="h5 pricing-currency text-primary mt-1 mb-0">$</sup>
                            <span class="fw-bolder display-5 mb-0 text-primary">99</span>
                            <sub class="pricing-duration font-small-4 ms-25 mt-auto mb-2">/month</sub>
                        </div>
                    </div>
                    <ul class="ps-1 mb-2">
                        <li class="mb-50">10 Users</li>
                        <li class="mb-50">Up to 10 GB storage</li>
                        <li>Basic Support</li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center fw-bolder mb-50">
                        <span>Days</span>
                        <span>4 of 30 Days</span>
                    </div>
                    <div class="progress mb-50" style="height: 8px">
                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="65"
                            aria-valuemax="100" aria-valuemin="80"></div>
                    </div>
                    <span>4 days remaining</span>
                    <div class="d-grid w-100 mt-2">
                        <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                            Upgrade Plan
                        </button>
                    </div>
                </div>
            </div> --}}
            <!-- /Plan Card -->
        </div>
        <!--/ User Sidebar -->

        <!-- User Content -->
        <div class="col-xl-7 col-lg-7 col-md-7 order-0 order-md-1">
            <!-- User Pills -->
        
            <!--/ User Pills -->

            <!-- Project table -->
            <div class="card">
                <h4 class="card-header">User's Projects List</h4>
                <div class="table-responsive">
                    <table class="table datatable-project">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Project</th>
                                <th class="text-nowrap">Total Task</th>
                                <th>Progress</th>
                                <th>Hours</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /Project table -->
        </div>
        <!--/ User Content -->
    </div>
</section>

{{-- @include('content/_partials/_modals/modal-edit-user')
@include('content/_partials/_modals/modal-upgrade-plan') --}}
@endsection

@section('vendor-script')
{{-- Vendor js files --}}
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
{{-- data table --}}
<script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-user-view-account.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-user-view.js')) }}"></script>
@endsection