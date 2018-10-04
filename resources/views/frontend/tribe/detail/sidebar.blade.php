<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

use App\Models\Tribe;

?>
<div class="list-group">
	<a href="{{ route('tribe.detail.old', ['id' => $tribe->id]) }}" class="list-group-item list-group-item-action {{ $page == 'overview'?'active':'' }}">Overview</a>

	@if ($tribe->isOwner())
	<a href="{{ route('tribe.detail.edit.old', ['id' => $tribe->id]) }}" class="list-group-item list-group-item-action {{ $page == 'edit'?'active':'' }}">Edit Tribe</a>
	<a href="{{ route('tribe.detail.join_requests.old', ['id' => $tribe->id]) }}" class="list-group-item list-group-item-action {{ $page == 'join_requests'?'active':'' }}">
		Join Requests
		@if ($tribe->countJoinRequest() != 0)
		&nbsp;&nbsp;<span class="badge badge-pill badge-success">{{ $tribe->countJoinRequest() }}</span>
		@endif
	</a>
	@endif

	<a href="{{ route('tribe.detail.members.old', ['id' => $tribe->id]) }}" class="list-group-item list-group-item-action {{ $page == 'members'?'active':'' }}">Members</a>
	<a href="{{ route('tribe.detail.projects.old', ['id' => $tribe->id]) }}" class="list-group-item list-group-item-action {{ $page == 'projects'?'active':'' }}">Projects</a>
	@if ($tribe->isOwner())
	<a href="{{ route('tribe.detail.invites.old', ['id' => $tribe->id]) }}" class="list-group-item list-group-item-action {{ $page == 'invites'?'active':'' }}">Invite User</a>
	@endif
	<a href="{{ route('tribe.detail.discussions.old', ['id' => $tribe->id]) }}" class="list-group-item list-group-item-action {{ $page == 'discussions'?'active':'' }}">Discussions</a>
	<a href="{{ route('tribe.detail.messages.old', ['id' => $tribe->id]) }}" class="list-group-item list-group-item-action {{ $page == 'messages'?'active':'' }}">Messages</a>
</div>
