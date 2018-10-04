<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */
 ?>

@extends('backend.layouts.app')

@push('stylesheets')
<link href="{{ asset('css/backend/project/detail.css') }}"></script>
@endpush

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
<div id="page-wrapper" style="padding-top: 50px">
  <div class="panel panel-default">
    <div class="panel-heading">
      Project Detail
    </div>
    <div class="panel-body">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        <li class="active"><a href="#overview" data-toggle="tab">Overview</a>
        </li>
        <li><a href="#users" data-toggle="tab">Users</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane fade in active" id="overview">
          @include('backend.project.detail.overview')
        </div>
        <div class="tab-pane fade" id="users">
          @include('backend.project.detail.users')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
