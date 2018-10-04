<?php 

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Models;

class UserProfile extends Model {

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'user_profiles';

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
     * Return user.
     */
	public function user() {
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}