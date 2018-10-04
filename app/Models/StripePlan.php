<?php 

/**
 * @author Dejan
 * @since  Sep 21, 2018
 */

namespace App\Models;

class StripePlan extends Model {

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'stripe_plans';

	/**
	* Indicates if the model should be timestamped.
	*
	* @var bool
	*/
	public $timestamps = true;

	const PLAN_TRIBE_LEADER = 1;
	const PLAN_TRIBE_MEMBER = 2;
    const PLAN_SPONSOR		= 3;
}