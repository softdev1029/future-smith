<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */
?>

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/bs-maxlength/src/bootstrap-maxlength.js') }}" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/project/detail/partials/modal_join.js') }}" defer></script>
@endpush

@if (!$project->isJoined())
<!-- Modal -->
<div class="modal fade" id="model_join_project" tabindex="-1" role="dialog" aria-labelledby="model_join_project_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_join_project" action="{{ route('project.detail.join', ['id' => $project->id]) }}" method="post">
                @csrf
                <input type="hidden" name="_action" value="REQUEST" />

                <div class="modal-header">
                    <h5 class="modal-title" id="model_join_project_title">Request to join into project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Message -->
                    <div class="form-group">
                        <textarea class="form-control maxlength-handler" id="join_request_message" name="message" placeholder="Your Message" required rows="5" maxlength="1500"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Join</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif