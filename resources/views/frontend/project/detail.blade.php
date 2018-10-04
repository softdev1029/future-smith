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
    <script src="{{ asset('js/frontend/project/detail.js') }}" defer></script>
    <script type="text/javascript">
        var project_page = '{{ $page }}';
    </script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/project/detail.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    {{ show_messages() }}

    @if ($project->isJoined($user))
      @if ($page == "edit")
        @include('frontend.project.detail.edit')
      @else
        @include('frontend.project.detail_lead')
      @endif
    @else
      @include('frontend.project.detail_guest')
    @endif

</div>
@endsection
