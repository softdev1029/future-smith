<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

?>


@extends('layouts.app')

@push('scripts')
    <!-- Javascript Library -->

    <!-- Page Javascript -->
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('frontend.discussion.form')
        </div>
    </div>
</div>

@endsection