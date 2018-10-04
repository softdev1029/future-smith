<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

use App\Models\Project;
use App\Models\Topic;
use App\Models\File;

?>

@push('scripts')
    <!-- Javascript Library -->

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/invites/list.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/invites/list.css') }}" rel="stylesheet">
@endpush

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card">
                <div class="card-header page-title">Invitation</div>

                <div class="card-body">
                    <ul class="list-unstyled">
                        @forelse ($invites as $invite)
                        <li class="media mb-4">
                            <div class="media-body">
                                <h5 class="mt-0"><a href="{{ $invite->tribe->link() }}">{{ $invite->tribe->title }}</a></h5>
                            </div>
                        </li>
                        @empty
                        <li class="no-data text-center mt-4">No Invitation</li>
                        @endforelse
                    </ul>
                </div>

                {{ $invites->links() }}
            </div>
        </div>
    </div>
</div>
