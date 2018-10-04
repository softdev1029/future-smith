
<?php

/**
 * @author Dejan
 * @since  Sep 24, 2018
 */

?>
@push('scripts')
<link href="{{ asset('css/frontend/discussion/partials/list.css') }}" rel="stylesheet">
@endpush

<!-- post create text box -->
<input type=text class="post-input" placeholder="Post something to the group..."><a href="{{ route('discussion.showcreate', ['type' => !empty($type) ? $type : '', 'ref_id' => !empty($ref_id) ? $ref_id : '']) }}" class="float-right add-discussion-link"><i class="icon-plus"></i></a></input>
@forelse ($discussions as $discussion)
<div class="post-date">{{ $discussion->created_at }}</div>
<div class="post-user">{{ $discussion->user->profile->name }}</div>
<div class="post-title">{{ $discussion->title }}</div>
<div class="post-summary">{{ $discussion->description }}</div>
@empty
<div class="">No Discussions</div>
@endforelse
