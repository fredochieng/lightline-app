@extends('layouts/contentLayoutMaster')

@section('title', 'My Invites/Referrals')

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

<!-- Responsive Datatable -->
<section id="responsive-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">My Invites</h4>
                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light"
                        data-bs-toggle="modal" data-bs-target="#newInviteModal">
                        <i data-feather='plus'></i> New Invite</button>
                </div>
                <div class="card-datatable">
                    <table class="dt-responsive-invites table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@include('panel::_partials/modal-refer-earn')
<!--/ Responsive Datatable -->
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
<script src="{{ asset(mix('js/scripts/tables/user-referrals.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>

<script>
    function myFunction() {
    // Get the text field
    var copyText = document.getElementById("refLink");
    
    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    
    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
    }
</script>

<script>
    $(document).ready(function() {
      $('#send_invites').on('click', function() {
          var emails = $('#emails').val();
          var user_id = $('#user_id').val();
          var myRefLink = $('#myRefLink').val();

          // Post request using Ajax
              $.ajax({
                  url: "/user/send-invites",
                  type: "POST",
                  data: {
                      _token: $("#csrf").val(),
                      type: 1,
                      l9ky0xwifr3sqtzv: user_id,
                      emails: emails,
                      myRefLink: myRefLink
                  },
                  cache: false,
                  success: function(response) {
                      var response = JSON.parse(response);
                      var isRtl = $('html').attr('data-textdirection') === 'rtl';
                      if (response.statusCode == 200) {
                        // Show toastr notification
                        toastr['success'](response.message, 'Send Invites', {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                        });

                        location.reload();
                        
                      } else if (response.statusCode == 201) {
                          toastr['error'](response.message, 'Send Invites', {
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
@endsection