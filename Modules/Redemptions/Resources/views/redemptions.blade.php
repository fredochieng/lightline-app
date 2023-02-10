@extends('layouts/contentLayoutMaster')

@section('title', 'Redemptions')

@section('vendor-style')
{{-- vendor css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection


@section('content')

<!-- Advanced Search -->
{{-- <section id="advanced-search-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Advanced Search</h4>
                </div>
                <!--Search Form -->
                <div class="card-body mt-2">
                    <form class="dt_adv_search" method="POST">
                        <div class="row g-1 mb-md-1">
                            <div class="col-md-4">
                                <label class="form-label">Name:</label>
                                <input type="text" class="form-control dt-input dt-full-name" data-column="1"
                                    placeholder="Alaric Beslier" data-column-index="0" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email:</label>
                                <input type="text" class="form-control dt-input" data-column="2"
                                    placeholder="demo@example.com" data-column-index="1" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Post:</label>
                                <input type="text" class="form-control dt-input" data-column="3"
                                    placeholder="Web designer" data-column-index="2" />
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-md-4">
                                <label class="form-label">City:</label>
                                <input type="text" class="form-control dt-input" data-column="4" placeholder="Balky"
                                    data-column-index="3" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Date:</label>
                                <div class="mb-0">
                                    <input type="text" class="form-control dt-date flatpickr-range dt-input"
                                        data-column="5" placeholder="StartDate to EndDate" data-column-index="4"
                                        name="dt_date" />
                                    <input type="hidden" class="form-control dt-date start_date dt-input"
                                        data-column="5" data-column-index="4" name="value_from_start_date" />
                                    <input type="hidden" class="form-control dt-date end_date dt-input"
                                        name="value_from_end_date" data-column="5" data-column-index="4" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Salary:</label>
                                <input type="text" class="form-control dt-input" data-column="6" placeholder="10000"
                                    data-column-index="5" />
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="my-0" />
                <div class="card-datatable">
                    <table class="dt-advanced-search table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Post</th>
                                <th>City</th>
                                <th>Date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Post</th>
                                <th>City</th>
                                <th>Date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!--/ Advanced Search -->

<!-- Responsive Datatable -->
<section id="responsive-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Redemption History</h4>
                    @if($user_points->points_balance >= 50)
                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light"
                        data-bs-toggle="modal" data-bs-target="#newRedemptionModal">
                        <i data-feather='plus'></i> New Redemption</button>
                    @else
                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light"
                        data-bs-toggle="modal" data-bs-target="#lessPointsModal">
                        <i data-feather='plus'></i> New Redemption</button>
                    @endif
                </div>
                <div class="card-datatable">
                    <table class="dt-responsive table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Redemption No</th>
                                <th>Points</th>
                                <th>Request Date</th>
                                <th>Expected Date</th>
                                <th>Date Paid</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Responsive Datatable -->
@include('redemptions::_partials/_modals/modal-new-redemption')
@include('redemptions::_partials/_modals/modal-less-points')
@endsection


@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>

<script>
    $(document).ready(function() {
      $('#redeemPointsBtn').on('click', function() {
          var points_balance = $('#points_balance').val();
          var redeem_points = $('#redeem_points').val();

          // Calculate new points balance
          let new_balance = points_balance - redeem_points
          
          // Post request using Ajax
              $.ajax({
                  url: "/user/redeem-points",
                  type: "POST",
                  data: {
                      _token: $("#csrf").val(),
                      type: 1,
                      points_balance: points_balance,
                      redeem_points: redeem_points,
                      new_balance: new_balance
                  },
                  cache: false,
                  success: function(response) {
                      //console.log(response);
                      var response = JSON.parse(response);
                      var isRtl = $('html').attr('data-textdirection') === 'rtl';
                     // alert(response.statusCode);
                      if (response.statusCode == 200) {
                        toastr['success'](response.message, {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                    });
                    window.location = "/user/redemptions";
                      } else if (response.statusCode == 201) {
                        toastr['error'](response.message, {
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

{{-- <script>
    $(document).ready(function() {
        var assetPath = '../../../app-assets/';
        var url = window.location;
        alert(assetPath)
        var dt_responsive_table = $('.dt-responsive');

        // if (dt_responsive_table.length) {
        var dt_responsive = dt_responsive_table.DataTable({
        ajax: assetPath + 'data/table-datatable.json',
        columns: [
        { data: 'responsive_id' },
        { data: 'full_name' },
        { data: 'email' },
        { data: 'post' },
        { data: 'city' },
        { data: 'start_date' },
        { data: 'salary' },
        { data: 'age' },
        { data: 'experience' },
        { data: 'status' }
        ],
        columnDefs: [
        {
        className: 'control',
        orderable: false,
        targets: 0
        },
        {
        // Label
        targets: -1,
        render: function (data, type, full, meta) {
        var $status_number = full['status'];
        var $status = {
        1: { title: 'Current', class: 'badge-light-primary' },
        2: { title: 'Professional', class: ' badge-light-success' },
        3: { title: 'Rejected', class: ' badge-light-danger' },
        4: { title: 'Resigned', class: ' badge-light-warning' },
        5: { title: 'Applied', class: ' badge-light-info' }
        };
        if (typeof $status[$status_number] === 'undefined') {
        return data;
        }
        return (
        '<span class="badge rounded-pill ' +
                      $status[$status_number].class +
                      '">' +
            $status[$status_number].title +
            '</span>'
        );
        }
        }
        ],
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l>
            <"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i>
                    <"col-sm-12 col-md-6"p>>',
                        responsive: {
                        details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                        var data = row.data();
                        return 'Details of ' + data['full_name'];
                        }
                        }),
                        type: 'column',
                        renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                        return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                        ? '<tr data-dt-row="' +
                            col.rowIdx +
                            '" data-dt-column="' +
                            col.columnIndex +
                            '">' +
                            '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                            '<td>' +
                                col.data +
                                '</td>' +
                            '</tr>'
                        : '';
                        }).join('');
        
                        return data ? $('
                        <table class="table" />').append('<tbody>' + data + '</tbody>') : false;
                        }
                        }
                        },
                        language: {
                        paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                        }
                        }
                        });
                        //}
       
    });
</script> --}}
@endsection