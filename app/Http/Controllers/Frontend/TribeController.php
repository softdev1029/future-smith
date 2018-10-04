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
use App\Models\User;
use App\Models\Tribe;
use App\Models\StripePlan;

class TribeController extends Controller
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
        $tribes = Tribe::whereRaw('1=1');
        $tribes = $tribes->paginate(self::COUNT_PER_PAGE);

        return view('frontend.tribe.list', ['tribes' => $tribes]);
    }

    /**
     * Create new tribe
     */
    public function create(Request $request) {
        $user = Auth::user();

        if (!$user->accessRightByTribeNumber()) {
            add_message(__('message.tribe.max_create', ['max' => User::MAX_TRIBE_CREATE_COUNT]), 'danger');
            return redirect()->route('tribe.list');
        }

        if ($request->isMethod('POST')) {
            $tribe = $request->tribe;

            $tribe = new Tribe();
            $tribe->title       = $request->tribe['title'];
            $tribe->description = $request->tribe['description'];
            $tribe->location    = $request->tribe['location'];
            $tribe->topic_id    = $request->tribe['topic_id'];
            $tribe->creator_id  = $user->id;

            $tribe->save();

            $tribe->members()->attach($user->id,
                ['status' => User::STATUS_ACCEPT,
                 'message' => '']);

            add_message(__('message.tribe.created'), 'success');

            return redirect()->route('tribe.list');
        }

        return view('frontend.tribe.create', [
            'tribe' => new Tribe(),
            'user' => $user,
            'plan' => StripePlan::find(StripePlan::PLAN_TRIBE_LEADER)
        ]);
    }
}
