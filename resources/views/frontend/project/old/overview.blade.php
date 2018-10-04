<div class="card">
    <div class="card-header page-title">
    		Overview
    		@if (!$project->isJoined() && !$project->isOwner())
    		<div class="float-right">
		        <a class="btn btn-primary" href="#model_join_project" role="button" data-toggle="modal">I Want To Join!</a>
    		</div>
            @else
            <div class="float-right">
                <a class="btn btn-primary disabled" href="#" role="button">Request Already Sent</a>
            </div>
    		@endif
    </div>
    <div class="card-body">
		<div class="media">
		    <img class="mr-3 rounded" src="{{ file_url($project->image(), 'get', 'thumb') }}" alt="{{ $project->title }}">
		    <div class="media-body">
		        <h5 class="mt-0"><a href="{{ route('project.detail', ['id' => $project->id]) }}">{{ $project->title }}</a></h5>
                <p class="mb-1"><strong>Author:</strong> {{ $project->user->profile->name }}</p>
		        <p>{{ $project->description }}</p>
		    </div>
		</div>
    </div>
</div>

@include('frontend.project.detail.partials.modal_join')