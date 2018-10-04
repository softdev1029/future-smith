@extends('backend.layouts.app')

@push('scripts')
<!-- Morris Charts JavaScript -->
<script src="{{ asset('backend/vendor/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('backend/vendor/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('backend/data/morris-data.js') }}"></script>
@endpush

@section('content')

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Dashboard</h1>
    </div>
  </div>

  <!-- Counts Section -->
  <section class="dashboard-counts section-padding">
    <div class="container-fluid">
      @include('backend.dashboard.counts')
    </div>
  </section>

  <!-- Statistics Section-->
  <section class="statistics section-padding section-no-padding-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          @include('backend.dashboard.notifications')
        </div>
    </div>
  </section>
</div>
@endsection
