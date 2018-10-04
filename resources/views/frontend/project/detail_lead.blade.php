<?php

/**
 * @author Dejan
 * @since  Sep 27, 2018
 */

?>

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/project/detail_lead.css') }}" rel="stylesheet">
@endpush

<div class="row">

  <!-- project cover image -->
  <div class="col col-lg-5">
    <img class="project-cover" src="{{ file_url($project->image(), 'get', 'thumb') }}" alt="no image"/>
  </div>

  <!-- project overview (name, summary, ... ) -->
  <div class="col col-lg-7">

    <!-- project name -->
    <div class="project-title">{{ $project->title }}</div>

    <!-- project summary -->
    <div class="project-summary">{{ $project->description }}</div>

    <!-- is project leader?, manage project -->
    <div class="">

      <!-- is project leader? -->
      @if ($project->isOwner())
      <div class="project-edit-btn"><button class="btn btn-light-gray">You are a leader of this Project&nbsp;<i class="fa fa-angle-down"></i></button></div>
      @else
      <div class="project-edit-btn"><button class="btn btn-light-gray">You are a member of this Project&nbsp;<i class="fa fa-angle-down"></i></button></div>
      @endif

      <!-- manage project -->
      @if ($project->isOwner())
      <a href="{{ route('project.detail.edit', ['id' => $project->id]) }}" class="btn btn-gray project-edit-btn"><i class="fas fa-cog"></i>&nbsp;Manage Project</a>
      @endif
    </div>
  </div>
</div>
<div>
  <nav class="nav project-nav">
    <a class="nav-link active project-nav-link" href="{{ route('project.detail', ['id' => $project->id]) }}">PROJECT DETAILS</a>
    <a class="nav-link project-nav-link" href="{{ route('project.detail.discussions', ['id' => $project->id]) }}">DISCUSSION</a>
  </nav>

  @include('frontend.project.detail.' . $page)
</div>
