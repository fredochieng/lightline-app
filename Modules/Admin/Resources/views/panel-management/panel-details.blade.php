@extends('layouts/contentLayoutMaster')

@section('title', 'Form Wizard')

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
<section class="horizontal-wizard">
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
                        <span class="bs-stepper-subtitle">All point Transactions</span>
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
                        <span class="bs-stepper-title">Address</span>
                        <span class="bs-stepper-subtitle">Add Address</span>
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
                        <span class="bs-stepper-title">Social Links</span>
                        <span class="bs-stepper-subtitle">Add Social Links</span>
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
                    <button class="btn btn-outline-secondary btn-prev" disabled>
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>
            <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Transactions</h5>
                    <small>All transactions within the account</small>
                </div>
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
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>
            <div id="address-step" class="content" role="tabpanel" aria-labelledby="address-step-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Address</h5>
                    <small>Enter Your Address.</small>
                </div>
                <form>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control"
                                placeholder="98  Borough bridge Road, Birmingham" />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="landmark">Landmark</label>
                            <input type="text" name="landmark" id="landmark" class="form-control"
                                placeholder="Borough bridge" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="pincode1">Pincode</label>
                            <input type="text" id="pincode1" class="form-control" placeholder="658921" />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="city1">City</label>
                            <input type="text" id="city1" class="form-control" placeholder="Birmingham" />
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>
            <div id="social-links" class="content" role="tabpanel" aria-labelledby="social-links-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Social Links</h5>
                    <small>Enter Your Social Links.</small>
                </div>
                <form>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="twitter">Twitter</label>
                            <input type="text" id="twitter" name="twitter" class="form-control"
                                placeholder="https://twitter.com/abc" />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="facebook">Facebook</label>
                            <input type="text" id="facebook" name="facebook" class="form-control"
                                placeholder="https://facebook.com/abc" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="google">Google+</label>
                            <input type="text" id="google" name="google" class="form-control"
                                placeholder="https://plus.google.com/abc" />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="linkedin">Linkedin</label>
                            <input type="text" id="linkedin" name="linkedin" class="form-control"
                                placeholder="https://linkedin.com/abc" />
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-success btn-submit">Submit</button>
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
<script src="{{ asset('js/scripts/tables/panel-transactions.js') }}"></script>
@endsection