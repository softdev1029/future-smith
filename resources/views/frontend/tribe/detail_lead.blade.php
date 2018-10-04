<?php

/**
 * @author Dejan
 * @since  Sep 27, 2018
 */

?>

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/tribe/detail_lead.css') }}" rel="stylesheet">
@endpush

<!-- tribe overview box -->
<div class="tribe-overview-box">

  <!-- tribe name -->
  <div class="tribe-name">{{ $tribe->title }}</div>

  <!-- manage project -->
  @if ($tribe->isOwner())
  <a href="{{ route('tribe.detail.edit', ['id' => $tribe->id]) }}" class="btn btn-gray tribe-edit-btn1"><i class="fas fa-cog"></i>&nbsp;Manage Tribe</a>
  @endif

  <!-- is project leader? -->
  <div>
    @if ($tribe->isOwner())
    <div class="tribe-type-btn1"><button class="btn btn-light-gray">You are a leader of this Tribe&nbsp;<i class="fa fa-angle-down"></i></button></div>
    @else
    <div class="tribe-type-btn1"><button class="btn btn-light-gray">You are a member of this Tribe&nbsp;<i class="fa fa-angle-down"></i></button></div>
    <a class="btn-light-gray-rect" href="{{ route('tribe.detail.leave', ['id' => $tribe->id]) }}">Leave this Tribe</a>
    @endif
    <a class="btn btn-light-gray" href="{{ route('project.create', ['id' => $tribe->id]) }}">Create a project</a>
  </div>

  <div class="row tribe-infos">
    <!-- tribe indicator -->
    <div class="col-lg-2 tribe-indicator"><i class="fa fa-users"></i>&nbsp;TRIBE</div>

    <!-- tribe location -->
    <div class="col-lg-2 tribe-location"><i class="fa fa-map-marker-alt"></i>&nbsp;{{ $tribe->location }}</div>

    <!-- tribe member count -->
    <div class="col-lg-2 tribe-member-count">{{ $tribe->members()->count() }}&nbsp;members</div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4">
    <!-- tribe cover -->
    <div class="tribe-cover-div"><img class="img-fluid mb-3 tribe-cover-img" src="{{ file_url($tribe->image(), 'get', 'thumb') }}" alt="no image"/></div>

    <!-- tribe summary -->
    <div class="tribe-summary">{{ $tribe->description }}</div>

    <!-- tribe members header -->
    <div class="tribe-members-header">

    <!-- tribe members title -->
    <div class="tribe-members-title">Tribe members ({{ $tribe->members()->count() }})<span><i class="fas fa-angle-right"></i></span></div>
    </div>

    <!-- tribe members list -->
    <?php
      $members = $tribe->members()->get();
      $parent = $tribe;
     ?>
    @include('frontend.user.partials.list')
  </div>

  <div class="col-lg-8">
    <!-- tribe discussions list -->
    <?php
      $discussions = $tribe->discussions;
      $parent = $tribe;
      $type = 2; // Discussion::TYPE_TRIBE
      $ref_id = $tribe->id;
     ?>
    @include('frontend.discussion.partials.list')
  </div>
</div>
