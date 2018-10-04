@if ($current_user->unreadNotifications->count() != 0)
	<span class="badge badge-pill badge-danger">{{ $current_user->unreadNotifications->count() }}</span>

	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarNotificationDropdown">
		@foreach ($current_user->unreadNotifications as $notification)
		    <a class="dropdown-item" href="#"><small>{{ $notification->data['message'] }}</small></a>

		    @if (!$loop->last)
		    <div class="dropdown-divider"></div>
		    @endif
		@endforeach
	</div>
@endif