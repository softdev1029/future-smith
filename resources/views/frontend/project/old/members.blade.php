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
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Form Style -->
@endpush

<div class="card">
	<div class="card-header page-title">Members</div>
	<div class="card-body">
		<form method="post">
			@csrf

			@if (!$members->isEmpty())
			<table class="table table-striped">
				<tbody>
				@foreach ($members as $member)
					<tr>
						<th scope="row">
							<a href="{{ $member->link() }}"><img src="{{ file_url($member->image()) }}" class="img-fluid rounded-circle" width="50" />&nbsp; {{ $member->profile->name }}</a>
						</th>
						<td class="align-middle text-right">{{ date('M j, Y H:i', strtotime($member->pivot->created_at)) }}</td>
						<!-- <td class="align-middle text-right">
							<button class="btn btn-danger" data-toggle="tooltip" title="Decline" data-id="{{ $member->id }}" data-action="DECLINE"><i class="icon-dislike"></i></button>
						</td> -->
					</tr>
				@endforeach
				</tbody>
			</table>
			@else
			<div class="no-data text-center">No Members.</div>
			@endif

			<input type="hidden" name="_action" />
			<input type="hidden" name="member_id" />
		</form>
	</div>
</div>