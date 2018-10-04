<?php 

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Models;

class Message extends Model {

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'messages';

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
     * Send message
     * @param $sender The sender
     * @param $receiver The receiver
     * @param $message The message
     */
    public static function send($sender, $receiver, $message) {
    	if (!$sender)
    		$sender = Auth::user();

    	$message = new Message();
    	$message->sender_id   = $sender->id;
    	$message->receiver_id = $receiver->id;
    	$message->message     = $message;
    	$message->save();

    	return true;
    }

    /**
     * Marked As Read
     */
    public function markedAsRead($user = null) {
    	if (!$user)
    		$user = Auth::user();

    	if ($this->isMakredAsRead($user))
    		return false;

    	$this->reader_ids .= "[$user->id]"; 
    	$this->save();

    	return true;
    }

    public function isMakredAsRead($user = null) {
    	if (!$user)
    		$user = Auth::user();

    	return strpos($this->reader_ids, "[$user->id]");
    }
}