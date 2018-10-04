<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

use App\Models\Discussion;
use App\Models\Topic;

?>

@extends('layouts.app')

@push('scripts')
    <!-- Javascript Library -->

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/discussion/detail.js') }}" defer></script>
    <script type="text/javascript">
        var discussion_page = '{{ $page }}';
    </script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/discussion/detail.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ show_messages() }}

            <div class="card">
                <div class="card-header page-title">
                        Overview
                </div>
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0"><a href="{{ route('discussion.detail', ['id' => $discussion->id]) }}">{{ $discussion->title }}</a></h5>
                            <p class="mb-1"><strong>Author:</strong> {{ $discussion->user->profile->name }}</p>
                            <p>{{ $discussion->description }}</p>
                            <a href="{{ route('discussion.detail.edit', ['id' => $discussion->id]) }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
