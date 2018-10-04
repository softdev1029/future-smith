<?php 

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

namespace App\Models;

class EmailTemplate extends Model {
	const USER_EMAIL_VERIFICATION = 'user_email_verification';
	const USER_FORGOT_PASSWORD    = 'user_forgot_password';
	const USER_MEMBERSHIP_CANCEL  = 'user_membership_cancel';
	const USER_MEMBERSHIP_EXPIRE  = 'user_membership_expire';
	const USER_MESSAGE_RECEIVE    = 'user_message_receive';

	/**
	 * Get the subject by email template key
	 * @param $key The key of email template
	 * @return String The subject of email.
	 */
	public static function getSubject($key, $params = []) {
		$subject = 'No Title';

		switch ($key) {
			case self::USER_EMAIL_VERIFICATION:
				$subject = __('mail.register_verify');
				break;
			case self::USER_FORGOT_PASSWORD:
				$subject = __('mail.forgot_password');
				break;
			case self::USER_MEMBERSHIP_CANCEL:
				$subject = __('mail.membership_cancel');
				break;
			case self::USER_MEMBERSHIP_EXPIRE:
				$subject = __('mail.membership_expire');
				break;
			case self::USER_MESSAGE_RECEIVE:
				$subject = __('mail.message_receive');
				break;
			default:
				break;
		}

		return str_replace_array('?', $params, $subject);
	}
}