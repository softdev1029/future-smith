<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */
?>

@extends('backend.layouts.app')

@push('scripts')
<!-- DataTables JavaScript -->
<script src="{{ asset('backend/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
 $('#dataTables-example').DataTable({
     responsive: true
 });
});
</script>
@endpush

@section('content')
<div id="page-wrapper">

  <!-- header -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Notifications</h1>
      </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">

        <!-- header -->
        <div class="panel-heading">
            Users
        </div>
        <div class="panel-body">
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                  <th>Message</th>
                  <th>Created At</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($notifications as $notification)
              <tr class="odd gradeX">
                <td>{{ $notification->data }}</td>
                <td>{{ $notification->created_at }}</td>
              </tr>
              @empty
                No Data
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
