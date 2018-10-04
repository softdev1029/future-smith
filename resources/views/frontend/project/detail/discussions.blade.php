<?php

/**
 * @author Dejan
 * @since  Sep 24, 2018
 */

?>

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Self Style -->
    <link href="{{ asset('css/frontend/project/detail/discussions.css') }}" rel="stylesheet">
@endpush

<div class="row">

  <!-- project volunteers -->
  <div class="col col-md-3">

    <?php
      $title = "Project volunteers ($project->members()->count())";
      $members = $project->members()->get();
      $parent = $project;
     ?>
    @include('frontend.user.partials.list')
  </div>

  <!-- posts -->
  <div class="col col-md-9">
    @include('frontend.discussion.partials.list')
  </div>
</div>
