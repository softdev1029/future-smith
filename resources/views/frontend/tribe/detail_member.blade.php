<?php

/**
 * @author Dejan
 * @since  Sep 27, 2018
 */

?>

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/tribe/detail_member.css') }}" rel="stylesheet">
@endpush

<!-- tribe overview box -->
<div class="tribe-overview-box">

  <!-- tribe name -->
  <div class="tribe-name">Facilitators Gone Rogue</div>

  <div class="row tribe-infos">
    <!-- tribe indicator -->
    <div class="col-lg-2 tribe-indicator"><i class="fal fa-users"></i>&nbsp;TRIBE</div>

    <!-- tribe location -->
    <div class="col-lg-2 tribe-location"><i class="fal fa-map-marker-alt"></i>&nbsp;Hawthorn</div>

    <!-- tribe member count -->
    <div class="col-lg-2 tribe-member-count">26&nbsp;members</div>
  </div>

  <div class="row">
    <div class="col-lg-5">
      <!-- tribe cover -->
      <div class="tribe-cover-div"><img class="img-fluid mb-3 tribe-cover-img" src="{{ file_url(null) }}" alt="no image"/></div>
    </div>

    <div class="col-lg-7">
      <!-- tribe summary -->
      <div class="tribe-summary">Facilitators Gone Rogue is a tribe for people that have significant experience in facilitation or have a strong appreciation for facilitation skills. Facilitation is such a valuable skills to have and is transferrable to many settings.</div>

      <!-- tribe join -->
      <div class="tribe-join"><button class="btn btn-light-gray">Request to Join</button></div>
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
      <div class="tribe-members-title">Tribe members (26)<span><i class="fas fa-angle-right"></i></span></div>

      <!-- tribe members see all -->
      <div class="tribe-members-see-all">See all</div>
    </div>

    <!-- tribe members body -->
    <div class="row">

      <!-- first column of tribe members -->
      <div class="col-lg-6">
        <!-- tribe members list -->
        <ul class="list-unstyled user-list">

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

      <!-- second column of tribe members -->
      <div class="col-lg-6">
        <!-- tribe members list -->
        <ul class="list-unstyled user-list">

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
  </div>

  <!-- tribe project members -->
  <div class="col-lg-5">
    <!-- tribe project members header -->
    <div class="tribe-project-members-header">
      <!-- tribe project members title -->
      <div class="tribe-project-members-title">Projects members are involved in (5)</div>

      <!-- tribe project members see all -->
      <div class="tribe-project-members-see-all">See all</div>
    </div>

    <!-- tribe members list -->
    <ul class="list-unstyled user-list">

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
