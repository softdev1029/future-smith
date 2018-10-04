<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

use App\Models\Discussion;
use App\Models\Topic;

?>

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>
    <script src="{{ asset('plugins/bs-maxlength/src/bootstrap-maxlength.js') }}" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/discussion/form.js') }}" defer></script>

    <script type="text/javascript"></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Form Style -->
    <link href="{{ asset('css/frontend/discussion/form.css') }}" rel="stylesheet">
@endpush

<div class="card">
    <div class="card-header page-title">{{ empty($discussion->id)?'New Discussion':'Edit Discussion' }}</div>

    <div class="card-body">
        <form id="discussion_create_form" action="{{ !empty($discussion->id)?route('discussion.detail.edit', ['id' => $discussion->id]):route('discussion.create') }}" method="post">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="discussion_title">Discussion Title</label>
                <input type="text" class="form-control" id="discussion_title" name="discussion[title]" placeholder="Title" required value="{{ $discussion->title }}">
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="discussion_description">Discussion Content</label>
                <textarea class="form-control maxlength-handler" id="discussion_description" name="discussion[description]" placeholder="Content" required rows="3" maxlength="1500">{{ $discussion->description }}</textarea>
            </div>

            <!-- Topic -->
            <div class="form-group">
                <label for="discussion_topic_id" class="d-block">What is the topic of your discussion?</label>
                <select class="form-control custom-select w-25" id="discussion_topic_id" name="discussion[topic_id]" required>
                    <option value="0">Choose a topic</option>
                    @foreach (Topic::all() as $topic)
                    <option value="{{ $topic->id }}" {{ $discussion->topic_id == $topic->id?'selected':'' }}>{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (empty($discussion->id))
            <button type="button" class="btn btn-primary" data-action="CREATE" data-type="{{ $type }}" data-ref_id="{{ $ref_id }}">Create</button>
            @else
            <button type="button" class="btn btn-primary" data-action="EDIT" data-type="{{ $type }}" data-ref_id="{{ $ref_id }}">Save</button>
            @endif

            <input type="hidden" name="type" />
            <input type="hidden" name="ref_id" />
        </form>
    </div>
</div>