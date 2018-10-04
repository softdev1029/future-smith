<?php

/**
 * @author Dejan
 * @since  Sep 27, 2018
 */

?>

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/tribe/detail_guest.css') }}" rel="stylesheet">
@endpush

<!-- tribe overview box -->
<div class="tribe-overview-box">

  <!-- tribe name -->
  <div class="tribe-name">{{ $tribe->title }}</div>

  <div class="row tribe-infos">
    <!-- tribe indicator -->
    <div class="col-lg-2 tribe-indicator"><i class="fa fa-users"></i>&nbsp;TRIBE</div>

    <!-- tribe location -->
    <div class="col-lg-2 tribe-location"><i class="fa fa-map-marker-alt"></i>&nbsp;{{ $tribe->location }}</div>

    <!-- tribe member count -->
    <div class="col-lg-2 tribe-member-count">{{ $tribe->members()->count() }}&nbsp;members</div>
  </div>

  <div class="row">
    <div class="col-lg-5">
      <!-- tribe cover -->
      <div class="tribe-cover-div"><img class="img-fluid mb-3 tribe-cover-img" src="{{ file_url($tribe->image()) }}" alt="no image"/></div>
    </div>

    <div class="col-lg-7">
      <!-- tribe summary -->
      <div class="tribe-summary">{{ $tribe->description }}</div>

      <!-- tribe join -->
      <a class="btn btn-light-gray tribe-join" href="#model_join_tribe" role="button" data-toggle="modal">Request to Join</a>
    </div>
  </div>
</div>

<!-- tribe members, tribe project members -->
<div class="row tribe-members-two-boxes">

  <!-- tribe members -->
  <div class="col-lg-7">

    <!-- tribe members header -->
    <div class="tribe-members-header">
      <!-- tribe members title -->
      <div class="tribe-members-title tribe-title-collapse" data-target="#tribe_members">Tribe members ({{ $tribe->members()->count() }})<span class="float-right d-lg-none d-block"><i class="fas fa-angle-right"></i></span></div>

      <!-- tribe members see all -->
      <div class="tribe-members-see-all d-lg-block d-none">See all</div>
    </div>

    <!-- tribe members body -->
    <div id="tribe_members" class="row d-lg-block d-none">
      <!-- tribe members list -->
      <ul class="list-unstyled user-list">

        @foreach ($tribe->members as $user)
        <li class="media mb-4 user-list-item">
            <img class="align-self-start mr-3 rounded user-avatar" src="{{ file_url($user->image()) }}">
            <div class="media-body">
                <h5 class="mt-0 user-name">{{ $user->name }}</h5>
                @if ($tribe->isOwner($user))
                <p class="user-role">Leader</p>
                @else
                <p class="user-role">Member</p>
                @endif
            </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>

  <!-- tribe project members -->
  <div class="col-lg-5">
    <!-- tribe project members header -->
    <div class="tribe-project-members-header">
      <!-- tribe project members title -->
      <div class="tribe-project-members-title tribe-title-collapse" data-target="#project_members">Projects members are involved in (5)<span class="float-right d-lg-none d-block"><i class="fas fa-angle-right"></i></span></div>

      <!-- tribe project members see all -->
      <div class="tribe-project-members-see-all d-lg-block d-none">See all</div>
    </div>

    <!-- tribe members list -->
    <ul id="project_members" class="list-unstyled user-list d-lg-block d-none">

      <!-- first tribe member -->
      <li class="media mb-4 user-list-item">
          <img class="align-self-start mr-3 rounded user-avatar" src="{{ file_url(null) }}">
          <div class="media-body">
              <h5 class="mt-0 user-name">Bob John</h5>
              <p class="user-role">Leader, Member</p>
          </div>
      </li>

      <!-- second tribe member -->
      <li class="media mb-4">
          <img class="align-self-start mr-3 rounded user-avatar" src="{{ file_url(null) }}">
          <div class="media-body">
              <h5 class="mt-0 user-name">Bob John</h5>
              <p class="user-role">Leader, Member</p>
          </div>
      </li>
    </ul>
  </div>
</div>

@include('frontend.tribe.detail.partials.modal_join')
