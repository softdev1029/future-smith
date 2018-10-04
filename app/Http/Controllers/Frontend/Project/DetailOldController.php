<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Http\Controllers\Frontend\Project;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\User;
use App\Models\Project;
use App\Models\Discussion;
use App\Models\Message\MessageThread;
use App\Notifications\ProjectJoinRequestSent;
use App\Notifications\ProjectJoinRequestAllowed;
use App\Notifications\ProjectJoinRequestDeclined;

class DetailOldController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Project Detail Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id) {
        $project = Project::find($id);

        if (!$project)
            abort(404);

        $user = Auth::user();
        if (!$user)
            abort(404);

        return view('frontend.project.old.detail', [
          'project' => $project,
          'user' => $user,
          'page' => 'overview'
        ]);
    }

    /**
     * Project Edit Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $project = Project::find($id);

        if (!$project)
            abort(404);

        $user = Auth::user();
        if (!$user)
            abort(404);

        if ($request->isMethod('POST')) {
            $project->title       = $request->project['title'];
            $project->description = $request->project['description'];
            $project->location    = $request->project['location'];
            $project->topic_id    = $request->project['topic_id'];

            $project->save();

            add_message(__('message.project.updated'), 'success');

            return redirect()->route('project.detail.old', ['id' => $project->id]);
        }

        return view('frontend.project.old.detail', [
          'project' => $project,
          'tribe' => $project->tribe,
          'user' => $user,
          'page' => 'edit'
        ]);
    }

    /**
     * Project Join Request Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function join_requests(Request $request, $id) {
        $project = Project::find($id);

        if (!$project)
            abort(404);

        $user = Auth::user();

        $join_requests = $project->members()
                                    ->wherePivot('status', User::STATUS_PENDING)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(self::COUNT_PER_PAGE);

        return view('frontend.project.old.detail', [
          'project' => $project,
          'user' => $user,
          'join_requests' => $join_requests,
          'page' => 'join_requests'
        ]);
    }

    /**
     * Project Members Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function members(Request $request, $id) {
        $project = Project::find($id);

        if (!$project)
            abort(404);

        $user = Auth::user();
        if (!$user)
            abort(404);

        $members = $project->members()
                              ->wherePivot('status', User::STATUS_ACCEPT)
                              ->orderBy('id', 'DESC')
                              ->paginate(self::COUNT_PER_PAGE);

        return view('frontend.project.old.detail', [
          'project' => $project,
          'user' => $user,
          'members' => $members,
          'page' => 'members'
        ]);
    }

    /**
     * Project Projects Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function projects(Request $request, $id) {
        $project = Project::find($id);

        if (!$project)
            abort(404);

        $user = Auth::user();
        if (!$user)
            abort(404);

        return view('frontend.project.old.detail', [
          'project' => $project,
          'user' => $user,
          'page' => 'projects'
        ]);
    }

    /**
     * Request to join
     */
    public function join(Request $request, $id) {
        $project = Project::find($id);

        if (!$project)
            abort(404);

        $user = Auth::user();

        $action = $request->_action;

        if (empty($action))
            abort(404);

        if ($action == 'REQUEST') {
            $project->members()->attach($user->id,
                ['status' => User::STATUS_PENDING,
                 'message' => $request->message]);

            $project->user->notify(new ProjectJoinRequestSent($project, $user));

            add_message(__('message.project.join'), 'success');
        } else {
            $member_id = $request->member_id;
            $project_member = $project->members()->find($member_id);

            if (!$project->isJoined($project_member)) {
                add_message(__('message.project.need_join'), 'danger');

                return redirect()->route('project.detail.old', ['id' => $project->id]);
            }

            if (!$project_member)
                abort(404);

            if ($action == 'ACCEPT') {

                $project->members()->updateExistingPivot($member_id, ['status' => User::STATUS_ACCEPT]);

                $project_member->notify(new ProjectJoinRequestAllowed($project, $user));

                add_message(__('message.project.accepted', ['user' => $project_member->profile->name]), 'success');
            } elseif ($action == 'DECLINE') {
                $project->members()->updateExistingPivot($member_id, ['status' => User::STATUS_DECLINE]);

                $project_member->notify(new ProjectJoinRequestDeclined($project, $user));

                add_message(__('message.project.declined', ['user' => $project_member->profile->name]), 'warning');
            } else {
                abort(404);
            }

            return redirect()->route('project.detail.join_requests.old', ['id' => $project->id]);
        }

        return redirect()->route('project.detail.old', ['id' => $project->id]);
    }

    /**
     * Project Discussions Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function discussions(Request $request, $id) {
        $project = Project::find($id);

        if (!$project)
            abort(404);

        $user = Auth::user();
        if (!$user)
            abort(404);

        if (!$user->accessRightByProject($project)) {
            add_message(__('message.project.need_join'), 'danger');
            return redirect()->route('project.detail.old', ['id' => $project->id]);
        }

        $discussions = $project->discussions;

        return view('frontend.project.old.detail', [
            'project' => $project,
            'user' => $user,
            'discussions' => $discussions,
            'page' => 'discussions',
            'type' => Discussion::TYPE_PROJECT,
            'ref_id' => $project->id
            ]);
    }

    /**
     * Project Messages Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function messages(Request $request, $id) {

        $project = Project::find($id);

        if (!$project)
            abort(404);

        $user = Auth::user();
        if (!$user)
            abort(404);

        $threads = MessageThread::getAllLatestByProject($id)->get();

        return view('frontend.project.old.detail', [
            'project' => $project,
            'user' => $user,
            'threads' => $threads,
            'page' => 'messages',
            'type' => MessageThread::TYPE_PROJECT,
            'ref_id' => $project->id
            ]);
    }
}
