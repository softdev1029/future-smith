<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Discussion;
use App\Models\Tribe;
use App\Models\Project;

class DiscussionController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $user = Auth::user();

        $type = $request->type;
        $ref_id = $request->ref_id;

        $discussions = Discussion::whereRaw('1=1');

        if ($type == Discussion::TYPE_TRIBE) {
            $tribe = Tribe::find($ref_id);
            $discussions = $tribe->discussions;
            return view('frontend.tribe.detail', [
                'tribe' => $tribe,
                'discussions' => $discussions,
                'page' => 'discussions',
                'type' => Discussion::TYPE_TRIBE,
                'ref_id' => $tribe->id
                ]);
        } else if ($type == Discussion::TYPE_PROJECT) {
            $project = Project::find($ref_id);
            $discussions = $project->discussions;
            return view('frontend.project.detail', [
                'project' => $project,
                'discussions' => $discussions,
                'page' => 'discussions',
                'type' => Discussion::TYPE_PROJECT,
                'ref_id' => $project->id,
                'user' => $user,
                ]);
        }
        return view('frontend.discussion.list', ['discussions' => $discussions]);
    }

    /**
     * Display view for create new discussion
     * type can be global, tribe, project.
     * ref_id can be null, tribe_id, project_id.
     */
    public function showCreate(Request $request, $type = null, $ref_id = null) {
        $user = Auth::user();

        if (!empty($type)) {
            if ($type == Discussion::TYPE_TRIBE) {
                $tribe = Tribe::find($ref_id);
                if (!$tribe->isJoined($user)) {
                    add_message(__('message.discussion.forbidden'), 'danger');
                    return redirect()->route('tribe.detail.discussions', ['id' => $ref_id]);
                }
            }
        }
        return view('frontend.discussion.create', [
            'discussion' => new Discussion(),
            'type' => $type,
            'ref_id' => $ref_id
            ]);
    }

    /**
     * Create new discussion
     * type can be global, tribe, project.
     * ref_id can be null, tribe_id, project_id.
     */
    public function create(Request $request) {
        $user = Auth::user();

        $type = $request->type;
        $ref_id = $request->ref_id;

        $discussion = new Discussion();
        $discussion->title       = $request->discussion['title'];
        $discussion->description = $request->discussion['description'];
        $discussion->topic_id    = $request->discussion['topic_id'];
        $discussion->creator_id  = $user->id;

        if (empty($type)) {
            $discussion->discussionable_type = Discussion::TYPE_GLOBAL;
        } else {
            $discussion->discussionable_type = $type;
            $discussion->discussionable_id = $ref_id;
        }

        $discussion->save();

        add_message(__('message.discussion.created'), 'success');

        return redirect()->route('discussion.list', [
            'type' => $type,
            'ref_id' => $ref_id
        ]);
    }
}
