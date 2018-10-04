@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Self Style -->
    <link href="{{ asset('css/frontend/project/detail/overview.css') }}" rel="stylesheet">
@endpush

<div class="row project-overview-body">

  <!-- project location, volunteers needed, ... -->
  <div class="col col-md-3 project-overview-box">

    <!-- project location -->
    <div class="project-infos"><span class="project-infos-title">Location:</span>&nbsp;<span class="project-infos-content">{{ $project->location }}</span></div>

    <!-- volunteers needed -->
    <div class="project-infos"><span class="project-infos-title">Volunteers needed:</span>&nbsp;<span class="project-infos-content">{{ $project->members }}&nbsp;/52</span></div>

    <!-- topic -->
    <div class="project-infos"><span class="project-infos-title">Topic:</span>&nbsp;<span class="project-infos-content">{{ $project->topicsToString() }}</span></div>

    <!-- skills required -->
    <div class="project-infos"><span class="project-infos-title">Skills required:</span>&nbsp;<span class="project-infos-content">{{ $project->skillsToString() }}</span></div>
  </div>

  <!-- project description (rich text) -->
  <div class="col col-md-9">
  </div>
</div>
