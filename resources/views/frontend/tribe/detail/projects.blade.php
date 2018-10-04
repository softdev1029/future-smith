<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

use App\Models\Tribe;
use App\Models\File;

?>

@push('scripts')
    <!-- Javascript Library -->
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Form Style -->
@endpush

<div class="card">
    <div class="card-header page-title">Projects<a href="{{ route('project.create', ['id' => $tribe->id]) }}" class="float-right add-project-link"><i class="icon-plus"></i></a></div>
    <div class="card-body">
    	<ul class="list-unstyled">
            @forelse ($projects as $project)
            <li class="media mb-4">
                <img class="align-self-start mr-3" src="{{ file_url($project->image(), 'get', 'thumb') }}" alt="{{ $project->title }}">
                <div class="media-body">
                    <h5 class="mt-0"><a href="{{ route('project.detail', ['id' => $project->id]) }}">{{ $project->title }}</a></h5>
                	<p class="mb-1"><strong>Author:</strong> <a href="{{ $project->user->link() }}">{{ $project->user->profile->name }}</a></p>
                    <p>{{ $project->description }}</p>
                </div>
            </li>
            @empty
            <li class="no-data text-center mt-4">No Projects</li>
            @endforelse
        </ul>
    </div>
</div>