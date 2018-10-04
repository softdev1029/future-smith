<?php

/**
 * @author Dejan
 * @since  Oct 1, 2018
 */

?>

@push('scripts')
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/backend/user/detail/memberships.css') }}" rel="stylesheet">
@endpush

@foreach ($plans as $plan)
	<div class="row pb-3">
		<div class="col-md-3">{{ $plan->name }}</div>
		<div class="col-md-5">
			@if (!$user->subscribed($plan->stripe_id))
				<button type="button" class="btn btn-outline btn-default">Not Joined</button>
			@elseif ($user->subscription($plan->stripe_id)->cancelled())
				<button type="button" class="btn btn-outline btn-warning">Cancelled</button>
			@else
				<button type="button" class="btn btn-outline btn-success">Joined</button>
			@endif
		</div>
	</div>
@endforeach
