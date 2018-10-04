<?php

/**
 * @author Dejan
 * @since  Sep 24, 2018
 */

?>

@extends('layouts.app')

@section('content')
@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>
    <script src="{{ asset('plugins/bs-maxlength/src/bootstrap-maxlength.js') }}" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/messenger/create.js') }}" defer></script>

    <script type="text/javascript"></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Form Style -->
    <link href="{{ asset('css/frontend/messenger/create.css') }}" rel="stylesheet">
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header page-title">Create a new message</div>

                <div class="card-body">
                    <form action="{{ route('messages.store') }}" method="post">
                        {{ csrf_field() }}
                        
                        <!-- Subject Form Input -->
                        <div class="form-group">
                            <label class="control-label">Subject</label>
                            <input type="text" class="form-control" name="subject" placeholder="Subject"
                                value="{{ old('subject') }}">
                        </div>

                        <!-- Message Form Input -->
                        <div class="form-group">
                            <label class="control-label">Message</label>
                            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                        </div>

                        @if($users->count() > 0)
                            <div class="checkbox">
                                @foreach($users as $user)
                                    <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]"
                                                                            value="{{ $user->id }}">{!!$user->name!!}</label>
                                @endforeach
                            </div>
                        @endif
                
                        <!-- Submit Form Input -->
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" data-action="CREATE" data-type="{{ $type }}" data-ref_id="{{ $ref_id }}">Create</button>
                        </div>

                        <input type="hidden" name="type" />
                        <input type="hidden" name="ref_id" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
