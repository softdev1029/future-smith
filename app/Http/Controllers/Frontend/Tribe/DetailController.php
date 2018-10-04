<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Http\Controllers\Frontend\Tribe;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

// Models
use App\Models\User;
use App\Models\Tribe;
use App\Models\Project;
use App\Models\TribeInvite;
use App\Models\Discussion;
use App\Models\StripePlan;
use App\Models\Message\MessageThread;

// Notifications
use App\Notifications\TribeJoinRequestReceived;
use App\Notifications\TribeJoinRequestAllowed;
use App\Notifications\TribeJoinRequestDeclined;
use App\Notifications\TribeInviteRequestReceived;


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
     * Tribe Detail Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        $user = Auth::user();
        if (!$user) {
          abort(404);
        }

        return view('frontend.tribe.detail', [
          'tribe' => $tribe,
          'user' => $user,
          'page' => 'overview'
        ]);
    }

    /**
     * Tribe Edit Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);
        $user = Auth::user();
        if (!$user) {
          abort(404);
        }

        if ($request->isMethod('POST')) {
            $tribe->title       = $request->tribe['title'];
            $tribe->description = $request->tribe['description'];
            $tribe->location    = $request->tribe['location'];
            $tribe->topic_id    = $request->tribe['topic_id'];

            $tribe->save();

            add_message(__('message.tribe.updated'), 'success');

            return redirect()->route('tribe.detail.edit', ['id' => $tribe->id]);
        }

        return view('frontend.tribe.old.detail', [
          'tribe' => $tribe,
          'user' => $user,
          'plan' => StripePlan::find(StripePlan::PLAN_TRIBE_LEADER),
          'page' => 'edit']);
    }

    /**
     * Tribe Join Request Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function join_requests(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        $user = Auth::user();

        $join_requests = $tribe->members()
                                    ->wherePivot('status', User::STATUS_PENDING)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(self::COUNT_PER_PAGE);

        return view('frontend.tribe.detail', [
          'tribe' => $tribe,
          'user' => $user,
          'join_requests' => $join_requests,
          'page' => 'join_requests'
        ]);
    }

    /**
     * Tribe Members Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function members(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        $user = Auth::user();
        if (!$user) {
          abort(404);
        }

        $members = $tribe->members()
                              ->wherePivot('status', User::STATUS_ACCEPT)
                              ->orderBy('id', 'DESC')
                              ->paginate(self::COUNT_PER_PAGE);

        return view('frontend.tribe.detail', [
          'tribe' => $tribe,
          'user' => $user,
          'members' => $members,
          'page' => 'members']);
    }

    /**
     * Tribe Projects Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function projects(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        $user = Auth::user();
        if (!$user) {
          abort(404);
        }

        $projects = Project::where('tribe_id', $tribe->id)
                           ->orderBy('id', 'DESC')
                           ->paginate(self::COUNT_PER_PAGE);

        return view('frontend.tribe.detail', [
          'tribe' => $tribe,
          'user' => $user,
          'projects' => $projects,
          'page' => 'projects']);
    }

    /**
     * Request to join
     */
    public function join(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        $user = Auth::user();

        $action = $request->_action;

        if (empty($action))
            abort(404);

        if ($action == 'REQUEST') {

            if ($user->membership() & User::MEMBERSHIP_TRIBE_MEMBER) {

                if ($user->tribes->count() >= User::MAX_TRIBE_COUNT) {
                  add_message(__('message.tribe.max_join', ['max' => User::MAX_TRIBE_COUNT]), 'warning');
                } else {
                  $tribe->members()->attach($user->id,
                      ['status' => User::STATUS_PENDING,
                      'message' => $request->message]);

                  $tribe->user->notify(new TribeJoinRequestReceived($tribe, $user));

                  add_message(__('message.tribe.join'), 'success');
                }
            } else {
                add_message(__('message.user.membership.need'), 'warning');
                return redirect()->route('user.memberships');
            }
        } else {
            $member_id = $request->member_id;
            $tribe_member = $tribe->members()->find($member_id);

            if (!$tribe->isJoined($tribe_member)) {
                add_message(__('message.tribe.need_join'), 'danger');

                return redirect()->route('tribe.detail', ['id' => $tribe->id]);
            }

            if (!$tribe_member)
                abort(404);

            // Accept joining request
            if ($action == 'ACCEPT') {
                $tribe_member->pivot->status = User::STATUS_ACCEPT;
                $tribe_member->pivot->save();

                $tribe_member->notify(new TribeJoinRequestAllowed($tribe, $user));

                add_message(__('message.tribe.accepted', ['user' => $tribe_member->profile->name]), 'success');
            } elseif ($action == 'DECLINE') { // Decline joining request
                $tribe_member->pivot->status = User::STATUS_DECLINE;
                $tribe_member->pivot->save();

                $tribe_member->notify(new TribeJoinRequestDeclined($tribe, $user));

                add_message(__('message.tribe.declined', ['user' => $tribe_member->profile->name]), 'warning');
            } else {
                abort(404);
            }

            return redirect()->route('tribe.detail.join_requests', ['id' => $tribe->id]);
        }

        return redirect()->route('tribe.detail', ['id' => $tribe->id]);
    }

    /**
     * Tribe Invites Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function invites(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);
        $user = Auth::user();
        if (!$user) {
          abort(404);
        }

        $users = User::leftJoin('tribe_invites', 'users.id', '=', 'tribe_invites.user_id')
                     ->addSelect('users.*')
                     ->addSelect('tribe_invites.status AS invite_status')
                     ->paginate(self::COUNT_PER_PAGE);

        return view('frontend.tribe.detail', [
            'tribe' => $tribe,
            'user' => $user,
            'users' => $users,
            'page' => 'invites'
        ]);
    }

    /**
     * Invite a user
     */
    public function invite(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        $user = Auth::user();

        $action = $request->_action;

        if (empty($action))
            abort(404);

        if ($action == 'INVITE') {

            $invite = new TribeInvite();
            $invite->tribe_id = $tribe->id;
            $invite->user_id = $request->user_id;
            $invite->message = '';

            $invite->save();

            $invite->user->notify(new TribeInviteRequestReceived($tribe, $user));

            add_message(__('message.tribe.invited'), 'success');
        }

        return redirect()->route('tribe.detail.invites', ['id' => $tribe->id]);
    }

    /**
     * Tribe Discussions Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function discussions(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        $user = Auth::user();
        if (!$user) {
          abort(404);
        }

        if (!$user->accessRightByTribe($tribe)) {
            add_message(__('message.tribe.need_join'), 'danger');
            return redirect()->route('tribe.detail', ['id' => $tribe->id]);
        }

        return view('frontend.tribe.detail', [
            'tribe' => $tribe,
            'user' => $user,
            'discussions' => $tripe->discussions,
            'page' => 'discussions',
            'type' => Discussion::TYPE_TRIBE,
            'ref_id' => $tribe->id
            ]);
    }

    /**
     * Tribe Messages Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function messages(Request $request, $id) {

        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);
        $user = Auth::user();
        if (!$user) {
          abort(404);
        }

        $threads = MessageThread::getAllLatestByTribe($id)->get();

        return view('frontend.tribe.detail', [
            'tribe' => $tribe,
            'user' => $user,
            'threads' => $threads,
            'page' => 'messages',
            'type' => MessageThread::TYPE_TRIBE,
            'ref_id' => $tribe->id
            ]);
    }

    /**
     * leave tribe
     */
    public function leave(Request $request, $id) {
        $tribe = Tribe::find($id);

        if (!$tribe)
            abort(404);

        $user = Auth::user();

        if (!$user)
            abort(404);

        $tribe->members()->detach($user->id);

        add_message(__('message.tribe.left'), 'success');

        return redirect()->route('tribe.detail', ['id' => $tribe->id]);
    }
}
