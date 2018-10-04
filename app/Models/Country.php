<?php 

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Models;

class Country extends Model {

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'countries';

	/**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	public $timestamps = false;

	function __construct() {
        parent::__construct();
    }
}