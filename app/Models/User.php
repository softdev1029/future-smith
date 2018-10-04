<?php

namespace App\Models;

use Mail;
use App\Models\EmailTemplate;
use App\Mail\EmailSend;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

use Laravel\Cashier\Billable;

use App\Models\File;

use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    use Notifiable, Billable, Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const STATUS_PENDING  = 1;
	  const STATUS_ACCEPT   = 2;
    const STATUS_DECLINE  = 3;

    // Status
    const ACTIVE   = 1;
    const INACTIVE = 2;

    // Role
    const ROLE_USER             = 1;
    const ROLE_ADMIN            = 2;

    const AVATAR_WIDTH   = 150;
    const AVATAR_HEIGHT  = 150;

    const MEMBERSHIP_VISITOR          = 1;
    const MEMBERSHIP_TRIBE_MEMBER     = 2;
    const MEMBERSHIP_TRIBE_OWNER      = 4;
    const MEMBERSHIP_PROJECT_LEAD     = 8;
    const MEMBERSHIP_SPONSOR          = 16;

    const MAX_TRIBE_COUNT = 3;
    const MAX_TRIBE_CREATE_COUNT = 3;

    /**
     * Check if user is admin or not
     */
    public function isAdmin() {
        return $this->role == self::ROLE_ADMIN;
    }

    /**
     * Send the password reset notification.
     * @see Illuminate\Auth\Passwords\CanResetPassword@sendPasswordResetNotification
     * @param  string  $token
     * @return void
     */
    public function sendRegisterActivateNotification() {
        Mail::to($this->email, $this->name)
            ->queue(new EmailSend(EmailTemplate::USER_EMAIL_VERIFICATION, [
                'user' => $this->name,
                'url'  => route('user.activate', ['token' => $this->token])
            ]));
    }

    /**
     * Send the password reset notification.
     * @see Illuminate\Auth\Passwords\CanResetPassword@sendPasswordResetNotification
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token) {
        Mail::to($this->email, $this->name)
            ->queue(new EmailSend(EmailTemplate::USER_FORGOT_PASSWORD, [
                'user' => $this->name,
                'url'  => route('password.reset', ['token' => $token])
            ]));
    }

    /**
     * Send membership cancellation notification.
     * @see
     * @param
     * @return void
     */
    public function sendMembershipCancelNotification() {
        Mail::to($this->email, $this->name)
            ->queue(new EmailSend(EmailTemplate::USER_MEMBERSHIP_CANCEL, [
                'user' => $this->name,
                'url'  => route('user.memberships')
            ]));
    }

    /**
     * Send membership expiration notification.
     * @see
     * @param
     * @return void
     */
    public function sendMembershipExpireNotification() {
        Mail::to($this->email, $this->name)
            ->queue(new EmailSend(EmailTemplate::USER_MEMBERSHIP_EXPIRE, [
                'user' => $this->name,
                'url'  => route('user.memberships')
            ]));
    }

    /**
     * Send message receive notification.
     * @see
     * @param
     * @return void
     */
    public function sendMessageReceiveNotification($sender, $message) {
        Mail::to($this->email, $this->name)
            ->queue(new EmailSend(EmailTemplate::USER_MESSAGE_RECEIVE, [
                'user' => $this->name,
                'sender' => $sender,
                'message' => $message,
                'url'  => route('user.memberships')
            ]));
    }

    /**
     * Get user avatar file
     * @param $id The user id
     */
    public static function avatar_file($id) {
        return File::where('target_id', $id)
                   ->where('type', File::TYPE_USER_AVATAR)
                   ->orderBy('id', 'DESC')
                   ->first();
    }

    /**
    * Get the profile record associated with the user.
    *
    * @return mixed
    */
    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile', 'user_id');
    }

    /**
     * Get user avatar
     * @param $id The id
     */
    public function image() {
        return File::where('target_id', $this->id)
                   ->where('type', File::TYPE_USER_AVATAR)
                   ->orderBy('id', 'DESC')
                   ->first();
    }

    /**
     * User Profile Link
     */
    public function link() {
        return route('user.detail', ['id' => $this->id]);
    }

    /**
     * The tribes that belong to the user.
     */
    public function tribes() {
        return $this->belongsToMany('App\Models\Tribe', 'tribe_members')
            ->withPivot('status', 'message')
            ->withTimestamps();
    }

    /**
     * The projects that belong to the user.
     */
    public function projects() {
        return $this->belongsToMany('App\Models\Project', 'project_members')
            ->withPivot('status', 'message')
            ->withTimestamps();
    }

    /**
     *
     */
    public function invite_status($tribe_id) {
        return DB::table('tribe_invites')
            ->where('tribe_id', $tribe_id)
            ->where('user_id', $this->id)
            ->first();
    }

    /**
     * get membership of user
     */
    public function membership() {
        $membership = User::MEMBERSHIP_VISITOR;
        $plans = StripePlan::all();
        foreach ($plans as $plan) {
            if ($this->subscribed($plan->stripe_id)) {
                if ($plan->id == StripePlan::PLAN_TRIBE_LEADER) {
                    $membership += User::MEMBERSHIP_TRIBE_OWNER;
                } else if ($plan->id == StripePlan::PLAN_TRIBE_MEMBER) {
                    $membership += User::MEMBERSHIP_TRIBE_MEMBER;
                } else if ($plan->id == StripePlan::PLAN_SPONSOR) {
                    $membership += User::MEMBERSHIP_SPONSOR;
                }
            }
        }
        return $membership;
    }

    /**
     * check access right
     */
    public function accessRightByTribe($tribe) {

        if ($tribe->isOwner($this)) {
            return true;
        }

        return $tribe->members()->where('user_id', $this->id)->first();
    }

    /**
     * check access right
     */
    public function accessRightByProject($project) {

        if ($project->isOwner($this)) {
            return true;
        }

        return $project->members()->where('user_id', $this->id)->first();
    }

    /**
     * role as string
     */
    public function roleToString() {
      if ($this->role == User::ROLE_USER) {
        return "user";
      } else if ($this->role == User::ROLE_ADMIN) {
        return "admin";
      }
    }

    /**
     * status as string
     */
    public function statusToString() {
      if ($this->status == User::ACTIVE) {
        return "active";
      } else if ($this->status == User::INACTIVE) {
        return "inactive";
      }
      return "unknown";
    }

    /**
     * check access right
     */
    public function accessRightByTribeNumber() {
        return $this->tribes()->count() < User::MAX_TRIBE_CREATE_COUNT;
    }
}
