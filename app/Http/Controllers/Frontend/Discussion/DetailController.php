<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

namespace App\Http\Controllers\Frontend\Discussion;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\User;
use App\Models\Discussion;

class DetailController extends Controller
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
     * Discussion Detail Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id) {
        $discussion = Discussion::find($id);

        if (!$discussion)
            abort(404);

        return view('frontend.discussion.detail', ['discussion' => $discussion, 'page' => 'overview']);
    }

    /**
     * Discussion Edit Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $discussion = Discussion::find($id);

        if (!$discussion)
            abort(404);

        if ($request->isMethod('POST')) {
            $discussion->title       = $request->discussion['title'];
            $discussion->description = $request->discussion['description'];
            $discussion->topic_id    = $request->discussion['topic_id'];

            $discussion->save();

            add_message(__('message.discussion.updated'), 'success');

            return redirect()->route('discussion.detail', ['id' => $discussion->id]);
        }

        return view('frontend.discussion.detail.edit', [
            'discussion' => $discussion,
            'type' => Discussion::TYPE_GLOBAL,
            'ref_id' => null
        ]);
    }
}
