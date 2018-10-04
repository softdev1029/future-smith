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
    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/tribe/create.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/tribe/create.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ show_messages() }}
            
            @include('frontend.tribe.form')
        </div>
    </div>
</div>
@endsection
