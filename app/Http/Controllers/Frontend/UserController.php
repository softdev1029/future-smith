<?php

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\User;
use App\Models\UserProfile;
use App\Models\StripePlan;
use App\Models\Tribe;
use App\Models\Project;
use App\Models\TribeInvite;

class UserController extends Controller
{

    // Status
    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 2;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Edit User Profile
     */
    public function edit(Request $request) {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile)
            $profile = new UserProfile();

        if ($request->isMethod('POST')) {

            $profile->name         = $request->profile['name'];
            $profile->overview     = $request->profile['overview'];
            $profile->suburb       = $request->profile['suburb'];
            $profile->state        = $request->profile['state'];
            $profile->topic_id     = $request->profile['topic_id'];
            $profile->user_id       = $user->id;

            $profile->save();
            $user->save(); // save avatar image

            add_message(__('message.user.updated'), 'success');

            return redirect()->route('user.edit');
        }

        return view('frontend.user.detail', [
            'profile'   => $profile,
            'user'      => $user,
            'page'      => 'edit'
        ]);
    }

    /**
     * View User Profile Page
     */
    public function detail(Request $request, $id = null) {
        $user = User::find($id);

        if (!$user)
            abort(404);

        return view('frontend.user.detail', [
            'user' => $user,
            'page' => 'overview'
        ]);
    }

    /**
     * Message Page
     */
    public function messages(Request $request, $id) {
        $user = User::find($id);

        if (!$user)
            abort(404);

        return view('frontend.user.detail', [
            'user' => $user,
            'page' => 'messages'
        ]);
    }

    /**
     * Invitation Page
     */
    public function invites(Request $request) {
        $user = Auth::user();

        if (!$user)
            abort(404);

        $invites = TribeInvite::where('user_id', '=', $user->id)
            ->orderBy('id', 'DESC')
            ->paginate(self::COUNT_PER_PAGE);

        return view('frontend.user.detail', [
            'invites' => $invites,
            'user' => $user,
            'page' => 'invites'
        ]);
    }

    /**
     * Memberships
     */
    public function memberships(Request $request) {
        $user = Auth::user();

        $action = $request->_action;

        if ($request->isMethod('POST') && !empty($action)) {
            $plan         = StripePlan::find($request->plan_id);
            $stripe_token = $request->stripeToken;

            if (!$plan)
                abort(404);

            try {
                // Create new subscription
                if ($action == 'CREATE' && !$user->subscribed($plan->stripe_id)) {
                    $user->newSubscription($plan->stripe_id, $plan->stripe_id)
                         ->create($stripe_token);

                    add_message(__('message.user.membership.created', ['plan' => $plan->name]), 'success');
                }

                // Cancel subscription
                if ($action == 'CANCEL' && $user->subscribed($plan->stripe_id)) {
                    $user->subscription($plan->stripe_id)
                         ->cancel();

                    $user->sendMembershipCancelNotification();

                    add_message(__('message.user.membership.cancelled', ['plan' => $plan->name]), 'success');
                }

                // Resume subscription
                if ($action == 'RESUME' && $user->subscription($plan->stripe_id)->cancelled()) {
                    $user->subscription($plan->stripe_id)
                         ->resume();

                    add_message(__('message.user.membership.resumed', ['plan' => $plan->name]), 'success');
                }
            } catch (Exception $e) {
                add_message($e->getMessage(), 'danger');
            }

            return redirect()->route('user.memberships');
        }

        return view('frontend.user.detail', [
            'user'  => Auth::user(),
            'plans' => StripePlan::all(),
            'page'  => 'memberships'
        ]);
    }

    /*
     * Tribes Page
     */
    public function tribes(Request $request, $id) {
        $user = User::find($id);

        if (!$user)
            abort(404);

        $tribes = $user->tribes()->wherePivot('status', User::STATUS_ACCEPT);
        $tribes = $tribes->paginate(self::COUNT_PER_PAGE);

        return view('frontend.user.detail', [
            'user' => $user,
            'tribes' => $tribes,
            'page' => 'tribes'
        ]);
    }

    /*
     * Leave Tribe
     */
    public function tribe_leave(Request $request, $user_id) {
        $user = User::find($user_id);
        $tribe = Tribe::find($request->tribe_id);

        if (!$user || !$tribe)
            abort(404);

        $tribe->members()->detach($user->id);

        add_message(__('message.tribe.left'), 'success');

        return $this->tribes($request, $user_id);
    }

    /**
     * Projects Page
     */
    public function projects(Request $request, $id) {
        $user = User::find($id);

        if (!$user)
            abort(404);

        $projects = $user->projects()->wherePivot('status', User::STATUS_ACCEPT);
        $projects = $projects->paginate(self::COUNT_PER_PAGE);

        return view('frontend.user.detail', [
            'user' => $user,
            'projects' => $projects,
            'page' => 'projects'
        ]);
    }

    /*
     * Leave Project
     */
    public function project_leave(Request $request, $user_id) {
        $user = User::find($user_id);
        $project = Project::find($request->project_id);

        if (!$user || !$project)
            abort(404);

        $project->members()->detach($user->id);

        add_message(__('message.project.left'), 'success');

        return $this->projects($request, $user_id);
    }

    /*
     *
     */
    public function notification_read(Request $request, $id) {
      dd('a');
      $user = Auth::user();
      $user->unreadNotifications->markAsRead();
    }
}
