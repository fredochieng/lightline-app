@extends('layouts/contentLayoutMaster')

@section('title', 'Point Transactions')

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
                    <h4 class="card-title">Search Point Transaction(s)</h4>
                </div>
                <!--Search Form -->
                <div class="card-body mt-2">
                    <form class="dt_adv_search" method="POST">
                        <div class="row g-1 mb-md-1">
                            <div class="col-md-3">
                                <label class="form-label">Transaction Number:</label>
                                <input type="text" class="form-control dt-input dt-full-name" data-column="1"
                                    placeholder="eg 1234" data-column-index="0" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Activity:</label>
                                <input type="text" class="form-control dt-input" data-column="3"
                                    placeholder="eg Redemption" data-column-index="2" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Transaction Type:</label>
                                <input type="text" class="form-control dt-input" data-column="4" placeholder="eg Debit"
                                    data-column-index="3" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Panel Number:</label>
                                <input type="text" class="form-control dt-input" data-column="5" placeholder="eg 345678"
                                    data-column-index="4" />
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-md-3">
                                <label class="form-label">Country:</label>
                                <input type="text" class="form-control dt-input" data-column="6" placeholder="eg Kenya"
                                    data-column-index="5" />
                            </div>
                            {{-- <div class="col-md-3">
                                <label class="form-label">Age:</label>
                                <input type="text" id="sal" class="form-control dt-input" data-column="6"
                                    placeholder="18 - 30" data-column-index="5" />
                                <input type="hidden" id="start_sal" class="form-control dt-date start_sal dt-input"
                                    data-column="6" data-column-index="5" name="value_from_start_sal" />
                                <input type="hidden" id="end_sal" class="form-control dt-date end_sal dt-input"
                                    name="value_from_end_sal" data-column="6" data-column-index="5" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Country:</label>
                                <input type="text" class="form-control dt-input" data-column="7" placeholder="Male"
                                    data-column-index="6" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Date:</label>
                                <div class="mb-0">
                                    <input type="text" class="form-control dt-date flatpickr-range dt-input"
                                        data-column="8" placeholder="StartDate to EndDate" data-column-index="7"
                                        name="dt_date" />
                                    <input type="hidden" class="form-control dt-date start_date dt-input"
                                        data-column="8" data-column-index="7" name="value_from_start_date" />
                                    <input type="hidden" class="form-control dt-date end_date dt-input"
                                        name="value_from_end_date" data-column="8" data-column-index="7" />
                                </div>
                            </div> --}}

                        </div>
                    </form>
                </div>
                <hr class="my-0" />
                <div class="card-datatable">
                    <table class="dt-advanced-search table" style="font-size:11px">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Trans Number</th>
                                <th>Points</th>
                                <th>Activity</th>
                                <th>Transaction Type</th>
                                <th>Panel Number</th>
                                <th>Country</th>
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
<script src="{{ asset('js/scripts/tables/points-management.js') }}"></script>
@endsection