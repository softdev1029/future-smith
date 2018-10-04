<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Project;
use App\Models\Tribe;
use App\Models\User;

class ProjectController extends Controller
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
    public function index() {
        $projects = Project::whereRaw('1=1')->get();
        //$projects = $projects->paginate(self::COUNT_PER_PAGE);

        return view('frontend.project.list', ['projects' => $projects]);
    }

    /**
     * Create new project
     */
    public function create(Request $request, $id) {
        $user = Auth::user();

        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        if (!Auth::user()->accessRightByTribe($tribe)) {
            add_message(__('message.tribe.need_join'), 'danger');
            return redirect()->route('tribe.detail', ['id' => $tribe->id]);
        }

        if (!$tribe->accessRightByProjectNumber()) {
            add_message(__('message.tribe.max_project', ['max' => Tribe::MAX_ENABLED_PROJECT]), 'danger');
            return redirect()->route('tribe.detail', ['id' => $tribe->id]);
        }

        if ($request->isMethod('POST')) {
            $project = $request->project;

            $project = new Project();
            $project->title         = $request->project['title'];
            $project->description   = $request->project['description'];
            $project->location      = $request->project['location'];
            $project->topic_id      = $request->project['topic_id'];
            $project->tribe_id      = $id;
            $project->creator_id    = $user->id;
            $project->members       = 0;
            $project->country_id    = 0;

            $project->save();

            $project->members()->attach($user->id,
                ['status' => User::STATUS_ACCEPT,
                 'message' => '']);

            add_message(__('message.project.created'), 'success');

            return redirect()->route('project.list');
        }

        return view('frontend.project.create', ['tribe' => $tribe, 'project' => new Project()]);
    }
}
