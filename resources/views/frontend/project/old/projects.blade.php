<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

use App\Models\Tribe;
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
    <div class="card-header page-title">Projects<a href="{{ route('project.create', ['id' => $tribe->id]) }}" class="float-right add-project-link"><i class="icon-plus"></i></a></div>
    <div class="card-body">
    	<div class="no-data text-center">Comming Soon!!!</div>
    </div>
</div>