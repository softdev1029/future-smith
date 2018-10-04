<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

use App\Models\Tribe;
use App\Models\Topic;
use App\Models\File;

?>

@extends('layouts.app')

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/tribe/list.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/tribe/list.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{ show_messages() }}

            <div class="card">
                <div class="card-header page-title">Tribes<a href="{{ route('tribe.create') }}" class="float-right add-tribe-link"><i class="icon-plus"></i></a></div>

                <div class="card-body">
                    <ul class="list-unstyled">
                        @forelse ($tribes as $tribe)
                        <li class="media mb-4">
                            <img class="align-self-start mr-3 rounded tribe-cover-img" src="{{ file_url($tribe->image(), 'get', 'thumb') }}" alt="{{ $tribe->title }}">
                            <div class="media-body">
                                <h5 class="mt-0"><a href="{{ $tribe->link() }}">{{ $tribe->title }}</a></h5>
                                <p class="mb-1"><strong>Author:</strong> <a href="{{ $tribe->user->link() }}">{{ $tribe->user->profile->name }}</a></p>
                                <p>{{ $tribe->description }}</p>
                            </div>
                        </li>
                        @empty
                        <li class="no-data text-center mt-4">No Tribes</li>
                        @endforelse
                    </ul>
                </div>

                {{ $tribes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
