<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Models;

use Auth;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tribe extends Model {

	use SoftDeletes;

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'tribes';

	const STATUS_ENABLE  = 1;
	const STATUS_DISABLE = 2;

    const MAX_ENABLED_PROJECT = 5;

    const IMAGE_WIDTH   = 300;
    const IMAGE_HEIGHT  = 300;

	/**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	public $timestamps = true;

	function __construct() {
        parent::__construct();
    }

    /**
     * Get tribe image
     * @param $id The id
     */
    public function image() {
        return File::where('target_id', $this->id)
                   ->where('type', File::TYPE_TRIBE)
                   ->where('is_approved', 1)
                   ->orderBy('id', 'DESC')
                   ->first();
    }

    /**
     * Creator
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    /**
     * Check whether current user is owner of this tribe or not
     */
    public function isOwner($user = null) {
        if (!$user)
            $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $this->creator_id == $user->id;
    }

    /**
     * Check whether current user is joined into tribe or not
     */
    public function isJoined($user = null) {
        if (!$user)
            $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $this->members()
            ->wherePivot('status', '<>', User::STATUS_DECLINE)
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * Get the member of tribe
     */
    public function member($user = null) {
        if (!$user)
            $user = Auth::user();

        return $this->members()
            ->wherePivot('status', '<>', User::STATUS_DECLINE)
            ->where('user_id', $user->id)
            ->first();
    }

    /**
     * Count of join request
     */
    public function countJoinRequest() {
        return $this->members()
            ->wherePivot('status', User::STATUS_PENDING)
            ->count();
    }

    /**
     * Tribe Link
     */
    public function link() {
        return route('tribe.detail', ['id' => $this->id]);
    }

    /**
     * The members that belong to the tribe.
     */
    public function members() {
        return $this->belongsToMany('App\Models\User', 'tribe_members')
            ->withPivot('status', 'message')
            ->withTimestamps();
    }

    /**
     * projects within the tribe
     */
    public function projects() {
        return $this->hasMany('App\Models\Project');
    }

    /**
     * check access right
     */
    public function accessRightByProjectNumber() {
        //return $this->projects()->where('status', Project::STATUS_ENABLE)->count() < Tribe::MAX_ENABLED_PROJECT;
        return $this->projects()->count() < Tribe::MAX_ENABLED_PROJECT;
    }

		/**
		 * project topic
		 */
		public function topics() {
			return $this->belongsToMany('App\Models\Topic');
		}

		/**
		 * topics string
		 */
		public function topicsToString() {
			$topics = $this->topics;
			$rlt = "";
			foreach ($topics as $topic) {
				$rlt .= $topic->name . ", ";
			}
			if (!empty($rlt)) {
				$rlt = substr($rlt, 0, strlen($rlt) - 2);
			}
			return $rlt;
		}

		/**
     * Get all of the tribe's discussions.
     */
    public function discussions()
    {
        return $this->morphMany('App\Models\Discussion', 'discussionable');
    }
}
