@extends('layouts/contentLayoutMaster')

@section('title', 'Panel Redemptions Requests')

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

<!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Search Panel Redemption(s)</h4>
                </div>
                <!--Search Form -->
                <div class="card-body mt-2">
                    <form class="dt_adv_search" method="POST">
                        <div class="row g-1 mb-md-1">
                            <div class="col-md-4">
                                <label class="form-label">Redemptions Number:</label>
                                <input type="text" class="form-control dt-input dt-full-name" data-column="1"
                                    placeholder="eg 1234" data-column-index="0" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Panel Number:</label>
                                <input type="text" class="form-control dt-input" data-column="3" placeholder="eg 345678"
                                    data-column-index="2" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Country:</label>
                                <input type="text" class="form-control dt-input" data-column="4" placeholder="eg Kenya"
                                    data-column-index="3" />
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="my-0" />
                <div class="card-datatable">
                    <table class="dt-advanced-search table" style="font-size:11px">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Redemptions Number</th>
                                <th>Points Redeemd</th>
                                <th>Panel Number</th>
                                <th>Country</th>
                                <th>Staus</th>
                                <th>Transaction Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Advanced Search -->

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
<script src="{{ asset('js/scripts/tables/redemptions-management.js') }}"></script>
@endsection