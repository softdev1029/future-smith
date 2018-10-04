<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

use App\Models\Project;
use App\Models\Topic;
use App\Models\File;

?>

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>
    <script src="{{ asset('plugins/jcrop/js/jquery.Jcrop.min.js') }}" defer></script>
    <script src="{{ asset('js/helpers/fileinput.js') }}" defer></script>
    <script src="{{ asset('plugins/bs-maxlength/src/bootstrap-maxlength.js') }}" defer></script>

    <script src="{{ asset('js/frontend/project/form.js') }}" defer></script>

    <script type="text/javascript">
        var IMAGE_WIDTH  = {{ Project::IMAGE_WIDTH }};
        var IMAGE_HEIGHT = {{ Project::IMAGE_HEIGHT }};
    </script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/fileinput/css/bs-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jcrop/css/jquery.Jcrop.min.css') }}" rel="stylesheet">

    <!-- Form Style -->
    <link href="{{ asset('css/frontend/project/form.css') }}" rel="stylesheet">
@endpush
<div class="card">
    <div class="card-header page-title">{{ empty($project->id)?'New Project':'Edit Project' }}</div>

    <div class="card-body">
        <form id="project_create_form" method="post" action="{{ !empty($project->id)?route('project.detail.edit', ['id' => $project->id]):route('project.create', ['id' => $tribe->id]) }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="project_title">Project Title</label>
                <input type="text" class="form-control" id="project_title" name="project[title]" placeholder="Title" required value="{{ $project->title }}">
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="project_description">Project Description</label>
                <textarea class="form-control maxlength-handler" id="project_description" name="project[description]" placeholder="Description" required rows="3" maxlength="1500">{{ $project->description }}</textarea>
            </div>

            <!-- Image -->
            <div class="form-group">
                <label class="control-value-avatar">Image</label>
                <div class="file-upload-container">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <span class="btn btn-success green btn-file">
                            <span class="fileinput-new "><i class="icon-cloud-upload"></i>&nbsp;&nbsp;Select</span>
                            <span class="fileinput-exists">Change</span>

                            <input type="file" id="image" class="form-control" name="attached_files"  {!! render_file_validation_options(File::TYPE_PROJECT) !!} />
                            <input type="hidden" name="file_ids">
                            <input type="hidden" name="file_type" value="{{ File::TYPE_PROJECT }}" />
                        </span>
                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
                <div id="temp_image" class="mt-2">
                    @if ($project->image())
                    <img src="{{ file_url($project->image(), 'get', 'thumb') }}" class="temp-image rounded" />
                    @endif
                </div>
            </div>

            <!-- Topic -->
            <div class="form-group">
                <label for="project_topic_id" class="d-block">What is the topic of your project?</label>
                <select class="form-control custom-select w-25" id="project_topic_id" name="project[topic_id]" required>
                    <option value="0">Choose a topic</option>
                @foreach (Topic::all() as $topic)
                    <option value="{{ $topic->id }}" {{ $project->topic_id == $topic->id?'selected':'' }}>{{ $topic->name }}</option>
                @endforeach
                </select>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label for="project_location">Where is the location of the project?</label>
                <input type="text" class="form-control" id="project_location" name="project[location]" placeholder="Area ex. Sydney" required value="{{ $project->location }}">
            </div>

            <button type="submit" class="btn btn-primary">{{ !empty($project->id)?'Save':'Create' }}</button>

            <input type="hidden" name="x1" class="x1" />
            <input type="hidden" name="y1" class="y1" />
            <input type="hidden" name="width" class="w" />
            <input type="hidden" name="height" class="h" />
        </form>
    </div>
</div>
