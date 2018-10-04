<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

use App\Models\Discussion;
use App\Models\Topic;

?>

@extends('layouts.app')

@push('scripts')
    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/discussion/create.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/discussion/create.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ show_messages() }}
            
            @include('frontend.discussion.form')
        </div>
    </div>
</div>
@endsection
