<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

use App\Models\Project;
use App\Models\Topic;
use App\Models\File;

?>

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>
    <script src="{{ asset('js/helpers/alert.js') }}" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/user/detail/projects.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/user/detail/projects.css') }}" rel="stylesheet">
@endpush

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card">
                <div class="card-header page-title">Projects</div>

                <div class="card-body">
                    <form action="{{ route('user.project.leave', ['user_id' => $user->id]) }}" method="post">
			            @csrf

                        <ul class="list-unstyled">
                            @forelse ($projects as $project)
                            <li class="media mb-4">
                                <img class="align-self-start mr-3 rounded" src="{{ file_url($project->image(), 'get', 'thumb') }}" alt="{{ $project->title }}">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="{{ $project->link() }}">{{ $project->title }}</a></h5>
                                    <p class="mb-1"><strong>Author:</strong> <a href="{{ $project->user->link() }}">{{ $project->user->profile->name }}</a></p>
                                    <p>{{ $project->description }}</p>
                                    <button type="button" class="btn btn-outline-danger" data-id="{{ $project->id }}" data-action="LEAVE"><i class="far fa-pause-circle"></i>&nbsp;&nbsp;Leave</button>
                                </div>
                            </li>
                            @empty
                            <li class="no-data text-center mt-4">No Projects</li>
                            @endforelse

                            <input type="hidden" name="project_id" />
                        </ul>
                    </form>
                </div>

                {{ $projects->links() }}
            </div>
        </div>
    </div>
</div>
