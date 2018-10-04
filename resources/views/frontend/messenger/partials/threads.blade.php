<?php

/**
 * @author Dejan
 * @since  Sep 24, 2018
 */

?>

@include('frontend.messenger.partials.flash')
{{ show_messages() }}

<div class="card">
    <div class="card-header page-title">Messages<a href="{{ route('messages.create', ['type' => !empty($type) ? $type : '', 'ref_id' => !empty($ref_id) ? $ref_id : '']) }}" class="float-right add-tribe-link"><i class="icon-plus"></i></a></div>

    <div class="card-body">
        <ul class="list-unstyled">
            @each('frontend.messenger.partials.thread', $threads, 'thread', 'frontend.messenger.partials.no-threads')
        </ul>
    </div>
</div>