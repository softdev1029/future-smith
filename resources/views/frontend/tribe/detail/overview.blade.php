<div class="card">
    <div class="card-header page-title">
    		Overview
    		@if (!$tribe->isJoined() && !$tribe->isOwner())
    		<div class="float-right">
		        <a class="btn btn-primary" href="#model_join_tribe" role="button" data-toggle="modal">I Want To Join!</a>
    		</div>
            @else
            <div class="float-right">
                <a class="btn btn-primary disabled" href="#" role="button">Request Already Sent</a>
            </div>
            @endif
    </div>
    <div class="card-body">
		<div class="media">
		    <img class="mr-3 rounded" src="{{ file_url($tribe->image(), 'get', 'thumb') }}" alt="{{ $tribe->title }}">
		    <div class="media-body">
		        <h5 class="mt-0"><a href="{{ route('tribe.detail', ['id' => $tribe->id]) }}">{{ $tribe->title }}</a></h5>
                <p class="mb-1"><strong>Author:</strong> {{ $tribe->user->profile->name }}</p>
		        <p>{{ $tribe->description }}</p>
		    </div>
		</div>
    </div>
</div>

@include('frontend.tribe.detail.partials.modal_join')