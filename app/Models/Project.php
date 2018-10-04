<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model {

	use SoftDeletes;

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'projects';

	/**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	public $timestamps = true;

	const STATUS_ENABLE  = 1;
	const STATUS_DISABLE = 2;

    const IMAGE_WIDTH   = 300;
    const IMAGE_HEIGHT  = 300;

	function __construct() {
        parent::__construct();
    }

    /**
     * Get tribe
     */
    public function tribe() {
        return $this->belongsTo('App\Models\Tribe', 'tribe_id');
    }

    /**
     * Creator
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    /**
     * Get project image
     * @param $id The id
     */
    public function image() {
        return File::where('target_id', $this->id)
                   ->where('type', File::TYPE_PROJECT)
                   ->where('is_approved', 1)
                   ->orderBy('id', 'DESC')
                   ->first();
    }

    /**
     * Check whether current user is owner of this project or not
     */
    public function isOwner($user = null) {
    	if (!$user)
    		$user = Auth::user();

    	return $this->creator_id == $user->id;
    }

    /**
     * Check whether current user is joined into project or not
     */
    public function isJoined($user = null) {
        if (!$user)
            $user = Auth::user();

        return $this->members()
                            ->where('user_id', $user->id)
                            ->wherePivot('status', '<>', User::STATUS_DECLINE)
                            ->exists();
    }

    /**
     * Get the member of project
     */
    public function member($user = null) {
        if (!$user)
            $user = Auth::user();

        return $this->members()
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
     * Project Link
     */
    public function link() {
        return route('project.detail', ['id' => $this->id]);
    }

    /**
     * The members that belong to the project.
     */
    public function members() {
        return $this->belongsToMany('App\Models\User', 'project_members')
            ->withPivot('status', 'message')
            ->withTimestamps();
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
		 * skills string
		 */
		public function skillsToString() {
			return "Communication Skills, Curiosity, Teaching";
		}

		/**
     * Get all of the project's discussions.
     */
    public function discussions()
    {
        return $this->morphMany('App\Models\Discussion', 'discussionable');
    }
}
