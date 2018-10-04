<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Models;

class Topic extends Model {

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'topics';

	/**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	public $timestamps = true;

	function __construct() {
        parent::__construct();
  }

	function projects() {
		return $this->belongsToMany('App\Models\Project');
	}
}
