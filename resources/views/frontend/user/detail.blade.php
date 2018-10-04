<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

use App\Models\User;
use App\Models\UserProfile;

?>

@extends('layouts.app')

@push('scripts')
    <!-- Javascript Library -->

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/user/detail.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    
    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/user/detail.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('frontend.user.detail.sidebar')
        </div>

        <div class="col-md-9">
            {{ show_messages() }}

            @include('frontend.user.detail.' . $page)
        </div>
    </div>
</div>
@endsection
