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
    <script src="{{ asset('js/frontend/project/list.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/project/list.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container">
  <!-- projects header -->
  <div class="projects-header">

    <!-- projects page title -->
    <h2>Projects</h2>

    <!-- projects page slogan -->
    <p>Our community create and run their own volunteering projects.&NewLine;If you can’t see a project that you’d like to join; create a new one!</p>
  </div>

  <!-- project filter -->
  <div class="project-filter">
    <div class="btn btn-filter-all mx-1 my-3">All</div>
    <div class="label-filter mx-1 my-3">Projects in</div>
    <div class="btn-filter-location mx-1 my-3">Hawthorn</div>
  </div>

  <!-- create button -->
  <a href="{{ route('tribe.list') }}" class="btn btn-gray btn-project-create my-3">Create Your Own Project</a>

  <div class="clearfix"></div>
  <!-- project grid -->
  @foreach ($projects->chunk(3) as $chunk)

    <div class="row project-list">
        @foreach ($chunk as $project)
            <div class="col-lg-4">
              @include ('frontend.project.partials.item')
            </div>
        @endforeach
    </div>
  @endforeach

</div>
@endsection
