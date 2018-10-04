<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

use App\Models\Tribe;
use App\Models\Topic;
use App\Models\File;

?>

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>
    <script src="{{ asset('plugins/bs-maxlength/src/bootstrap-maxlength.js') }}" defer></script>

    <script src="{{ asset('js/frontend/tribe/form.js') }}" defer></script>

    <script type="text/javascript">
        var IMAGE_WIDTH  = {{ Tribe::IMAGE_WIDTH }};
        var IMAGE_HEIGHT = {{ Tribe::IMAGE_HEIGHT }};
    </script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Form Style -->
    <link href="{{ asset('css/frontend/tribe/form.css') }}" rel="stylesheet">
@endpush

<!-- tribe name label -->
<div class="label-tribe-name">Name of your tribe</div>

<!-- tribe name input -->
<input style="display: inline-block" type="text" class="input-tribe-name"></input>

<!-- tribe summary label -->
<div class="label-tribe-summary">Summary</div>

<!-- tribe summary input -->
<input type="text" class="input-tribe-summary"></input>

<!-- tribe location label -->
<div class="label-tribe-location">Location</div>

<!-- tribe location input -->
<input type="text" class="input-tribe-location"></input>

<!-- tribe topic label -->
<div class="label-tribe-topic">Topic</div>

<!-- tribe topic input -->
<input type="text" class="input-tribe-topic"></input>

<!-- tribe cover label -->
<div class="label-tribe-cover">Upload a cover image</div>

<!-- tribe cover input -->
<input type="text" class="input-tribe-cover"></input>

<!-- save button -->
<button class="btn-save">Save</button>

<!-- cancel button -->
<button class="btn-cancel">Cancel</button>

@include('frontend.payment.stripe')
