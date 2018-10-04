<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

use App\Models\Tribe;

?>

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('js/helpers/alert.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Form Style -->
@endpush

<div class="card">
	<div class="card-header page-title">Invite Users</div>
	<div class="card-body">
		<form action="{{ route('tribe.detail.invite', ['id' => $tribe->id]) }}" method="post">
			@csrf

			@if (!$users->isEmpty())
			<table class="table table-striped">
				<tbody>
				@foreach ($users as $user)
					<tr>
						<th scope="row">
							<img src="{{ file_url($user->image()) }}" class="img-fluid rounded-circle" width="50" />&nbsp; <a href="{{ $user->link() }}">{{ $user->name }}</a>
						</th>
						<td class="align-middle text-right">{{ date('M j, Y H:i', strtotime($user->created_at)) }}</td>
						@if ($user->invite_status)
						<td class="align-middle text-right">
							Already Invited
						</td>
						@else
						<td class="align-middle text-right">
							<button class="btn btn-outline-primary" data-toggle="tooltip" title="Invite" data-id="{{ $user->id }}" data-action="INVITE">invite</button>
						</td>
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>

			{{ $users->links() }}

			@else
			<div class="no-data text-center">No Users.</div>
			@endif

			<input type="hidden" name="_action" />
			<input type="hidden" name="user_id" />
		</form>
	</div>
</div>
