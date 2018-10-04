<?php 

/**
 * @author Dejan
 * @since  Sep 20, 2018
 */

namespace App\Models;

class ProjectMember extends Model {

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'project_members';

	const STATUS_PENDING  = 1;
	const STATUS_ACCEPT   = 2;
	const STATUS_DECLINE  = 3;

	/**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	public $timestamps = true;

    /**
     * Return user.
     */
	public function user() {
		return $this->belongsTo('App\Models\User', 'user_id');
	}

    /**
     * Return project.
     */
	public function project() {
		return $this->belongsTo('App\Models\Project', 'project_id');
	}
}