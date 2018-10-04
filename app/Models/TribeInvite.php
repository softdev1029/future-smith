<?php 

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

namespace App\Models;

class TribeInvite extends Model {

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'tribe_invites';

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
     * Return tribe.
     */
	public function tribe() {
		return $this->belongsTo('App\Models\Tribe', 'tribe_id');
	}
}