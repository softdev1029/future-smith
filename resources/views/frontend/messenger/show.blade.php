@extends('layouts.app')

@push('scripts')
    <!-- Javascript Library -->

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/messenger/show.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/messenger/show.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header page-title">Messages</div>

                <div class="card-body">
                    <h1>{{ $thread->subject }}</h1>
                    @each('frontend.messenger.partials.messages', $thread->messages, 'message')

                    @include('frontend.messenger.partials.form-message')
                </div>
            </div>
        </div>
    </div>
</div>
@stop
