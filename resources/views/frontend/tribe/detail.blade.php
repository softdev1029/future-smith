<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

use App\Models\Tribe;
use App\Models\Topic;
use App\Models\File;

?>

@extends('layouts.app')

@push('scripts')
    <!-- Javascript Library -->

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/tribe/detail.js') }}" defer></script>
    <script type="text/javascript">
        var tribe_page = '{{ $page }}';
    </script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/tribe/detail.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">

  {{ show_messages() }}

  @if ($tribe->isOwner() || $tribe->isJoined())
    @include('frontend.tribe.detail_lead')
  @else
    @include('frontend.tribe.detail_guest')
  @endif
</div>
@endsection
