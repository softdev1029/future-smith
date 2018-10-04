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
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/discussion/list.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/discussion/list.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{ show_messages() }}

            @include('frontend.discussion.old.list')
        </div>
    </div>
</div>

@endsection
