@extends('layouts/contentLayoutMaster')

@section('title', 'Panel Details')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('content')
<section>
    <div class="col-lg-12 col-12">
        <div class="card card-statistics">
            <div class="card-body statistics-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12 mb-2 mb-md-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-primary me-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">${{ $panel_points->points_earned }}</h4>
                                <p class="card-text font-small-3 mb-0">Points Earned</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-2 mb-md-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-info me-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">${{ $panel_points->points_redeemed }}</h4>
                                <p class="card-text font-small-3 mb-0">Points Redeemed</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-2 mb-sm-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-danger me-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">${{ $panel_points->points_balance }}</h4>
                                <p class="card-text font-small-3 mb-0">Points Balance</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 col-sm-6 col-12">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-success me-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">$9745</h4>
                                <p class="card-text font-small-3 mb-0">Revenue</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Horizontal Wizard -->
<section class="modern horizontal-wizard">
    <div class="bs-stepper horizontal-wizard-example">
        <div class="bs-stepper-header" role="tablist">
            <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">1</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Account Details</span>
                        <span class="bs-stepper-subtitle">Setup Account Details</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Transactions</span>
                        <span class="bs-stepper-subtitle">All Point Transactions</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#address-step" role="tab" id="address-step-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">3</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Redemptions</span>
                        <span class="bs-stepper-subtitle">All Panel Redemptions</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#social-links" role="tab" id="social-links-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">4</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Referrals</span>
                        <span class="bs-stepper-subtitle">All Referrals by the Panel</span>
                    </span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
                <div class="content-header">
                    Account Status
                    @if ($panel_details->status == 0)
                    <span class="badge bg-light-warning">Pending</span>
                    @else
                    <span class="badge bg-light-success">Active</span>
                    @endif
                </div>
                <form>
                    <div class="row">
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="username">Panel Number</label>
                            <input type="text" class="form-control" value="{{ $panel_details->panel_no }}" />
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="email">Name</label>
                            <input type="text" class="form-control" value="{{ $panel_details->name}}" />
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="text" class="form-control" value="{{ $panel_details->email}}" />
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="email">Phone Number</label>
                            <input type="text" class="form-control" value="{{ $panel_details->phone_number}}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="username">Date of Birth</label>
                            <input type="text" class="form-control" value="{{ $panel_details->dob }}" />
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="email">Gender</label>
                            <input type="text" class="form-control" value="{{ $panel_details->gender}}" />
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="email">Marital Status</label>
                            <input type="text" class="form-control" value="{{ $panel_details->marital_status}}" />
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="email">Education Level</label>
                            <input type="text" class="form-control" value="{{ $panel_details->education_level}}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="username">Registration Source</label>
                            @if ($panel_details->registration_type == 1)
                            <input type="text" class="form-control" value="Organic" />
                            @else
                            <input type="text" class="form-control" value="Panel Referral" />
                            @endif
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="email">Joined At</label>
                            <input type="text" class="form-control"
                                value="{{ $panel_details->registration_timestamp}}" />
                        </div>
                    </div>

                </form>
                <div class="d-flex justify-content-between">
                    {{-- <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Transactions</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button> --}}
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Transactions</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>
            <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Transactions</h5>
                    <small>All transactions within the account</small>
                </div>
                <form></form>
                <div class="card-datatable">
                    <table class="dt-responsive-tx table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Points</th>
                                <th>Activity</th>
                                <th>Transaction Type</th>
                                <th>Transaction Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($point_transactions as $count=> $tx)
                            <tr>
                                <td>{{ $tx->transaction_id }}</td>
                                <td>{{ $tx->points }}</td>
                                <td>{{ $tx->activity }}</td>
                                <td>{{ $tx->tx_type }}</td>
                                <td>{{ $tx->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Account Details</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Redemptions</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>
            <div id="address-step" class="content" role="tabpanel" aria-labelledby="address-step-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Redemptions</h5>
                    <small>All the redemptions by the panel.</small>
                </div>
                <form></form>
               <div class="card-datatable">
                    <table class="dt-responsive-red table">
                        <thead>
                            <tr>
                                <th>Redemption No</th>
                                <th>Points</th>
                                <th>Request Date</th>
                                <th>Expected Date</th>
                                <th>Date Paid</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($panel_redemptions as $count=> $redemptions)
                            <tr>
                                <td>{{ $redemptions->redemption_no }}</td>
                                <td>{{ $redemptions->points_redeemed }}</td>
                                <td>{{ $redemptions->created_at }}</td>
                                <td>{{ $redemptions->expected_date }}</td>
                                <td>{{ $redemptions->date_paid }}</td>
                                @if ($redemptions->status == 1)
                                <td><span class="badge rounded-pill badge-light-primary">Pending</span></td>
                                @elseif ($redemptions->status == 2)
                                <td><span class="badge rounded-pill badge-light-success">Completed</span></td>
                                @endif
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Transactions</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Referrals</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>
            <div id="social-links" class="content" role="tabpanel" aria-labelledby="social-links-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Referrals</h5>
                    <small>Referrals by the panel.</small>
                </div>
                <form></form>
               <div class="card-datatable">
                    <table class="dt-responsive-ref table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($panel_referrals as $count=> $referrals)
                            <tr>
                                <td>{{ $referrals->name }}</td>
                                <td>{{ $referrals->email }}</td>
                                <td>{{ $referrals->created_at }}</td>
                                @if ($referrals->status == 0)
                                <td><span class="badge rounded-pill badge-light-primary">Pending</span></td>
                                @elseif ($referrals->status == 1)
                                <td><span class="badge rounded-pill badge-light-success">Verified</span></td>
                                @endif
                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Redemptions</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Horizontal Wizard -->

@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
<script src="{{ asset('js/scripts/tables/panel-details-tables.js') }}"></script>
@endsection