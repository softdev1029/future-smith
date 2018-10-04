<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

use App\Models\Project;
use App\Models\File;

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
	<div class="card-header page-title">Join Requests</div>
	<div class="card-body">
		<form action="{{ route('project.detail.join', ['id' => $project->id]) }}" method="post">
			@csrf

			@if (!$join_requests->isEmpty())
			<table class="table table-striped">
				<tbody>
				@foreach ($join_requests as $member)
					<tr>
						<th scope="row">
							<img src="{{ file_url($member->image()) }}" class="img-fluid rounded-circle" width="50" />&nbsp; {{ $member->profile->name }}</th>
						<td class="align-middle">{{ date('M j, Y H:i', strtotime($member->pivot->created_at)) }}</td>
						<td class="align-middle text-right">
							<button class="btn btn-success" data-toggle="tooltip" title="Accept" data-id="{{ $member->id }}" data-action="ACCEPT"><i class="icon-like"></i></button>
							<button class="btn btn-danger" data-toggle="tooltip" title="Decline" data-id="{{ $member->id }}" data-action="DECLINE"><i class="icon-dislike"></i></button>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			@else
			<div class="no-data text-center">No Requests.</div>
			@endif

			<input type="hidden" name="_action" />
			<input type="hidden" name="member_id" />
		</form>
	</div>
</div>