<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

namespace App\Models;

use Auth;

use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model {

	use SoftDeletes;

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'discussions';

	/**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	public $timestamps = true;

  /**
   * discussion type
   */
  const TYPE_GLOBAL   = 1;
  const TYPE_TRIBE    = 2;
  const TYPE_PROJECT  = 3;

	function __construct() {
        parent::__construct();
    }

    /**
     * Creator
     */
    public function user() {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    /**
     * Discussion Link
     */
    public function link() {
        return route('discussion.detail', ['id' => $this->id]);
    }

		/**
     * Get all of the owning discussionable models.
     */
    public function discussionable()
    {
        return $this->morphTo();
    }
}
