<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

use App\Models\Tribe;

?>
<div class="list-group">
	<a href="{{ route('project.detail.old', ['id' => $project->id]) }}" class="list-group-item list-group-item-action {{ $page == 'overview'?'active':'' }}">Overview</a>

	@if ($project->isOwner())
	<a href="{{ route('project.detail.edit.old', ['id' => $project->id]) }}" class="list-group-item list-group-item-action {{ $page == 'edit'?'active':'' }}">Edit Project</a>
	<a href="{{ route('project.detail.join_requests.old', ['id' => $project->id]) }}" class="list-group-item list-group-item-action {{ $page == 'join_requests'?'active':'' }}">
		Join Requests
		@if ($project->countJoinRequest() != 0)
		&nbsp;&nbsp;<span class="badge badge-pill badge-success">{{ $project->countJoinRequest() }}</span>
		@endif
	</a>
	@endif

	<a href="{{ route('project.detail.members.old', ['id' => $project->id]) }}" class="list-group-item list-group-item-action {{ $page == 'members'?'active':'' }}">Members</a>
	<a href="{{ route('project.detail.discussions.old', ['id' => $project->id]) }}" class="list-group-item list-group-item-action {{ $page == 'discussions'?'active':'' }}">Discussions</a>
	<a href="{{ route('project.detail.messages.old', ['id' => $project->id]) }}" class="list-group-item list-group-item-action {{ $page == 'messages'?'active':'' }}">Messages</a>
</div>
