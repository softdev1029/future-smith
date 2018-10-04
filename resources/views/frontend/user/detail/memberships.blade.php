<?php

/**
 * @author Dejan
 * @since  Sep 22, 2018
 */

use App\Models\User;
use App\Models\File;

?>

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('js/helpers/alert.js') }}" defer></script>

    <script src="{{ asset('js/frontend/user/detail/memberships.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    
    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/user/detail/memberships.css') }}" rel="stylesheet">
@endpush

<div class="card">
    <div class="card-header page-title">
    	Memberships
    </div>
    <div class="card-body">
    	<form method="post">
            @csrf
            <input type="hidden" name="_action" />
            <input type="hidden" name="plan_id" />

		    @foreach ($plans as $plan)
		    	<div class="row pb-3">
		    		<div class="col-md-7">{{ $plan->name }}</div>
		    		<div class="col-md-5 text-right">
		    			@if (!$user->subscribed($plan->stripe_id))
		    				<button type="button" class="btn btn-outline-primary" data-plan-id="{{ $plan->id }}" data-action="CREATE" data-toggle="modal" data-target="#model_join_stripe_plan"><i class="fa fa-sign-in-alt"></i>&nbsp;&nbsp;Join</button>
		    			@elseif ($user->subscription($plan->stripe_id)->cancelled())
		    				<button type="button" class="btn btn-outline-success"  data-plan-id="{{ $plan->id }}" data-action="RESUME"><i class="fa fa-play"></i>&nbsp;&nbsp;Resume</button>
		    			@else
		    				<button type="button" class="btn btn-outline-danger"  data-plan-id="{{ $plan->id }}" data-action="CANCEL"><i class="far fa-pause-circle"></i>&nbsp;&nbsp;Cancel</button>
		    			@endif
		    		</div>
		    	</div>
		    @endforeach
		</form>
    </div>
</div>

@include('frontend.payment.stripe')