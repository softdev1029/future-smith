<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

use App\Models\Tribe;

?>
<div class="list-group">
	<a href="{{ route('user.detail', ['id' => $user->id]) }}" class="list-group-item list-group-item-action {{ $page == 'overview'?'active':'' }}">Overview</a>
	
	@if ($current_user && $user->id == $current_user->id)
	<a href="{{ route('user.edit') }}" class="list-group-item list-group-item-action {{ $page == 'edit'?'active':'' }}">Edit Profile</a>
	<a href="{{ route('user.memberships') }}" class="list-group-item list-group-item-action {{ $page == 'memberships'?'active':'' }}">Memberships</a>
	<a href="{{ route('user.invites') }}" class="list-group-item list-group-item-action {{ $page == 'invites'?'active':'' }}">Invitation</a>

	<a href="{{ route('user.messages', ['id' => $user->id]) }}" class="list-group-item list-group-item-action {{ $page == 'messages'?'active':'' }}">
		Messages
	</a>

	<a href="#favorites-subs" class="list-group-item list-group-item-action" id="favorites" data-parent="#favorites" data-remote="true">
        <span style="">Favorites</span>
        <span class="menu-ico-collapse"><i class="fa fa-chevron-down"></i></span>
	</a>

	<div class="list-group-submenu" id="favorites-subs">
		<a class="list-group-item sub-item list-group-item-action {{ $page == 'tribes'?'active':'' }}"
			style="padding-left: 36px;" href="{{ route('user.tribes', ['id' => $user->id]) }}" data-parent="#favorites">
			- Tribes
		</a>
		<a class="list-group-item sub-item list-group-item-action {{ $page == 'projects'?'active':'' }}"
			style="padding-left: 36px;" href="{{ route('user.projects', ['id' => $user->id]) }}" data-parent="#favorites">
			- Projects
		</a>
	</div>
	@endif

</div>