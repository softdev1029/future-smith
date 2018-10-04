<?php

/**
 * @author Dejan
 * @since  Sep 27, 2018
 */

?>

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/project/detail_guest.css') }}" rel="stylesheet">
@endpush

<div class="row justify-content-center">

  <!-- project title, summary, ... -->
  <div class="col col-md-6">

    <!-- title -->
    <h2 class="project-title m-0 p-0">{{ $project->title }}</h2>

    <!-- location, members, ... -->
    <div class="row project-infos">

      <!-- location -->
      <div class="col col-md-4 project-location">
          <i class="icon-cloud-upload"></i>&nbsp;{{ $project->location }}
      </div>

      <!-- members -->
      <div class="col col-md-4">
        {{ $project->members()->count() }}&nbsp;members
      </div>

      <!-- date, ongoing -->
      <div class="col col-md-4">
        12 Jan 2017–&nbsp;Ongoing
      </div>
    </div>

    <!-- join -->
    <div class="btn-join">
      <a class="btn btn-gray" href="#model_join_project" role="button" data-toggle="modal">Request to Join</a>
    </div>

    <!-- summary -->
    <div class="project-summary">{{ $project->description }}</div>

    <!-- 'project details' title -->
    <div class="project-detail-title">
      Project Details
    </div>

    <!-- 'organizers' title -->
    <div class="project-organizer">
      Organizers:
    </div>

    <!-- tribe cover-image, tribe name  -->
    <div class="tribe-info">

      <!-- tribe cover-image -->
      <ul class="list-unstyled">
          <li class="media mb-4">
              <img class="align-self-start mr-3 rounded" src="{{ file_url($project->tribe->image(), 'get', 'thumb') }}">
              <div class="media-body">
                  <h5 class="mt-0 project-infos">{{ $project->tribe->title }}</h5>
                  <p>TRIBE</p>
              </div>
          </li>
      </ul>
    </div>
    <!-- project topic -->
    <div class="">
      <span class="project-topic">Topic:&nbsp;</span><span class="project-topic-content">{{ $project->topicsToString() }}</span>
    </div>

    <!-- created date -->
    <div class="">
      <span class="project-create-date">Created:&nbsp;</span><span class="project-infos">{{ $project->created_at }}</span>
    </div>
  </div>

  <!-- images -->
  <div class="col col-md-6">
    <div class="row">
      <div class="col"><img class="img-fluid mb-3 project-images"  src="{{ file_url(null) }}" alt="no image"/></div>
      <div class="col"><img class="img-fluid mb-3 project-images"  src="{{ file_url(null) }}" alt="no image"/></div>
    </div>
    <div class="row">
      <div class="col"><img class="img-fluid mb-3 project-images"  src="{{ file_url(null) }}" alt="no image"/></div>
      <div class="col"><img class="img-fluid mb-3 project-images"  src="{{ file_url(null) }}" alt="no image"/></div>
    </div>
  </div>
</div>

@include('frontend.project.detail.partials.modal_join')
