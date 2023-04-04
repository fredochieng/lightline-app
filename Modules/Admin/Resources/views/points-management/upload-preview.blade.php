@extends('layouts/contentLayoutMaster')

@section('title', 'Points Upload Preview')

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
                    <h4 class="card-title">Upload Preview - {{ $data_file_uuid }}</h4>

                    <form method="post" method="post" action="{{route('admin.process.bulk.upload')}}">
                        @csrf
                        <input type="hidden" name="data_file_uuid" value="{{ $data_file_uuid }}">
                        <input type="hidden" name="unique_file_name" value="{{ $unique_file_name }}">
                        <input type="hidden" name="reason" value="{{ $reason }}">
                        <a href="{{route('admin.show.award.points')}}"
                            class="btn btn-primary waves-effect waves-float waves-light"> <i class="feather feather-package"></i> Back
                        </a>
                        @if($batch_status == 'No')
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Process Bulk
                            Upload</button>
                        @else
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                            disabled>Process Bulk
                            Upload</button>
                        @endif
                    </form>
                </div>
                <div class="card-datatable">
                    <table class="dt-responsive table">
                        <thead>
                            <th>Name</th>
                            <th>Panel Number</th>
                            <th>Points</th>
                            <th>Batch ID</th>
                            <th>Processed</th>
                            <th>Batch Created At</th>
                        </thead>
                        <tbody>
                            @foreach($rows as $item)
                            <tr>
                                <td>{{ $item[0] }}</td>
                                <td>{{ $item[1] }}</td>
                                <td>{{ $reason }}</td>
                                <td>{{ $data_file_uuid }}</td>
                                @if($batch_status == 'Yes')
                                <td><span>{{ $batch_status }}</span></td>
                                @else
                                <td><span>{{ $batch_status }}</span></td>
                                @endif
                                <td>{{ $created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
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

@endsection