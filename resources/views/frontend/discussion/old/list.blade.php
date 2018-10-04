
<?php

/**
 * @author Dejan
 * @since  Sep 24, 2018
 */

?>

{{ show_messages() }}

<div class="card">
    <div class="card-header page-title">Discussions<a href="{{ route('discussion.showcreate', ['type' => !empty($type) ? $type : '', 'ref_id' => !empty($ref_id) ? $ref_id : '']) }}" class="float-right add-discussion-link"><i class="icon-plus"></i></a></div>

    <div class="card-body">
        <ul class="list-unstyled">
            @forelse ($discussions as $discussion)
            <li class="media mb-4">
                <div class="media-body">
                    <h5 class="mt-0"><a href="{{ $discussion->link() }}">{{ $discussion->title }}</a></h5>
                    <p class="mb-1"><strong>Author:</strong> <a href="{{ $discussion->user->link() }}">{{ $discussion->user->profile->name }}</a></p>
                    <p>{{ $discussion->description }}</p>
                </div>
            </li>
            @empty
            <li class="no-data text-center mt-4">No Discussions</li>
            @endforelse
        </ul>
    </div>
</div>
