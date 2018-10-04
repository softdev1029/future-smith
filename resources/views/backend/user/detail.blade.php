<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */
 ?>

@extends('backend.layouts.app')

@push('stylesheets')
<link href="{{ asset('css/backend/user/detail.css') }}"></script>
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
      User Detail
    </div>
    <div class="panel-body">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        <li class="active"><a href="#overview" data-toggle="tab">Overview</a>
        </li>
        <li><a href="#memberships" data-toggle="tab">Membership</a>
        </li>
        <li><a href="#tribes" data-toggle="tab">Tribes</a>
        </li>
        <li><a href="#projects" data-toggle="tab">Projects</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane fade in active" id="overview">
          @include('backend.user.detail.overview')
        </div>
        <div class="tab-pane fade" id="memberships">
          @include('backend.user.detail.memberships')
        </div>
        <div class="tab-pane fade" id="tribes">
          @include('backend.user.detail.tribes')
        </div>
        <div class="tab-pane fade" id="projects">
          @include('backend.user.detail.projects')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
