@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard | Lightline Online')

@section('vendor-style')
{{-- vendor css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection


@section('content')
<section id="statistics-card">
    <!-- Stats Horizontal Card -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ $total_panel }}</h2>
                        <p class="card-text">Total Panel</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="cpu" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ $active_panel }}</h2>
                        <p class="card-text">Active Panel</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="server" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ $inactive_panel }}</h2>
                        <p class="card-text">Inactive Panel</p>
                    </div>
                    <div class="avatar bg-light-danger p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="activity" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ $total_referrals }}</h2>
                        <p class="card-text">Total Referrals</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="alert-octagon" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Stats Horizontal Card -->

    <!-- Line Area Chart Card -->
    {{-- <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="users" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">{{ $total_pending_redemptions }}</h2>
                    <p class="card-text">Subscribers Gained</p>
                </div>
                <div id="line-area-chart-1"></div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="credit-card" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">97.5k</h2>
                    <p class="card-text">Revenue Generated</p>
                </div>
                <div id="line-area-chart-2"></div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-danger p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="shopping-cart" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">36%</h2>
                    <p class="card-text">Quarterly Sales</p>
                </div>
                <div id="line-area-chart-3"></div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="package" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">97.5K</h2>
                    <p class="card-text">Orders Received</p>
                </div>
                <div id="line-area-chart-4"></div>
            </div>
        </div>
    </div> --}}
    <!--/ Line Area Chart Card -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ $total_pending_redemptions }}</h2>
                        <p class="card-text">Pending Redemptions</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="cpu" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ $pending_redemptions_amount }}</h2>
                        <p class="card-text">Pending Redemptions Amount</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="server" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ $total_completed_redemptions }}</h2>
                        <p class="card-text">Completed Redemptions</p>
                    </div>
                    <div class="avatar bg-light-danger p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="activity" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">{{ $completed_redemptions_amount }}</h2>
                        <p class="card-text">Completed Redemptions Amount</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="alert-octagon" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Line Chart Card -->
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start pb-0">
                    <div>
                        <h2 class="fw-bolder"> {{ $sum_points_awarded }}</h2>
                        <p class="card-text">Total Points Awarded</p>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <div class="avatar-content">
                            <i data-feather="monitor" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
                <div id="line-area-chart-5"></div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start pb-0">
                    <div>
                        <h2 class="fw-bolder">{{ $sum_points_redeemed }}</h2>
                        <p class="card-text">Total Points Redeemed</p>
                    </div>
                    <div class="avatar bg-light-success p-50">
                        <div class="avatar-content">
                            <i data-feather="user-check" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
                <div id="line-area-chart-6"></div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start pb-0">
                    <div>
                        <h2 class="fw-bolder">{{ $sum_points_balance }}</h2>
                        <p class="card-text">Total Points Balance</p>
                    </div>
                    <div class="avatar bg-light-warning p-50">
                        <div class="avatar-content">
                            <i data-feather="mail" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
                <div id="line-area-chart-7"></div>
            </div>
        </div>
    </div>
    <!--/ Line Chart Card -->
</section>
@endsection


@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset('js/scripts/tables/panel-management.js') }}"></script>
@endsection