<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

use App\Models\User;
use App\Models\UserProfile;
use App\Models\File;
use App\Models\Topic;

?>

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>

    <!-- Page Javascript -->
    <script type="text/javascript">
        var IMAGE_WIDTH  = {{ User::AVATAR_WIDTH }};
        var IMAGE_HEIGHT = {{ User::AVATAR_HEIGHT }};
    </script>

    <script src="{{ asset('js/frontend/user/detail/edit.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">
    
    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/user/detail/edit.css') }}" rel="stylesheet">
@endpush

<div class="card">
    <div class="card-header page-title">Edit Your Profile</div>

    <div class="card-body">
        <form id="user_profile_form" action="{{ route('user.edit') }}" method="post">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="profile_name">Name</label>
                <input type="text" class="form-control" id="profile_name" name="profile[name]" placeholder="Full Name" required value="{{ $profile->name }}">
            </div>

            <!-- Image -->
            <div class="form-group">
                <label class="control-value-avatar">Your Avatar</label>
                <div class="file-upload-confileinputtainer">
                    <div class="fileinput-new" data-provides="fileinput">
                        <span class="btn btn-success green btn-file">
                            <span class="fileinput-new "><i class="icon-cloud-upload"></i>&nbsp;&nbsp;Select</span> 
                            <span class="fileinput-exists">Change</span>
                            
                            <input type="file" id="image" class="form-control" name="attached_files"  {!! render_file_validation_options(File::TYPE_USER_AVATAR) !!} />
                            <input type="hidden" name="file_ids">
                            <input type="hidden" name="file_type" value="{{ File::TYPE_USER_AVATAR }}" />
                        </span>
                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
                <div id="temp_image" class="mt-2">
                    @if ($profile->user)
                    <img src="{{ file_url($profile->user->image()) }}" class="temp-image rounded" />
                    @endif
                </div>
            </div>

            <!-- Suburb -->
            <div class="form-group">
                <label for="profile_suburb">Suburb</label>
                <input type="text" class="form-control" id="profile_suburb" name="profile[suburb]" placeholder="Suburb" required value="{{ $profile->suburb }}">
            </div>

            <!-- State -->
            <div class="form-group">
                <label for="profile_name">State</label>
                <input type="text" class="form-control" id="profile_state" name="profile[state]" placeholder="State" required value="{{ $profile->state }}">
            </div>

            <!-- Overview -->
            <div class="form-group">
                <label for="profile_overview">Brief introduction about yourself</label>
                <textarea class="form-control" id="profile_overview" name="profile[overview]" placeholder="Overview" required rows="3">{{ $profile->overview }}</textarea>
            </div>

            <!-- Topic -->
            <div class="form-group">
                <label for="profile_topic_id" class="d-block">What is the topic of your user?</label>
                <select class="form-control custom-select w-25" id="profile_topic_id" name="profile[topic_id]" required>
                    <option value="0">Choose a topic</option>
                    @foreach (Topic::all() as $topic)
                    <option value="{{ $topic->id }}" {{ $profile->topic_id == $topic->id?'selected':'' }}>{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>

            <input type="hidden" name="x1" class="x1" />
            <input type="hidden" name="y1" class="y1" />
            <input type="hidden" name="width" class="w" />
            <input type="hidden" name="height" class="h" />
        </form>
    </div>
</div>