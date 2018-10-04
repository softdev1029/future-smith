<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

use App\Models\Project;
use App\Models\Topic;
use App\Models\File;

?>

@extends('layouts.app')

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/project/create.js') }}" defer></script>

    <script type="text/javascript">
        var IMAGE_WIDTH  = {{ Project::IMAGE_WIDTH }};
        var IMAGE_HEIGHT = {{ Project::IMAGE_HEIGHT }};
    </script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/project/create.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ show_messages() }}

            @include('frontend.project.form')
        </div>
    </div>
</div>
@endsection
