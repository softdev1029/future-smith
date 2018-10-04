<?php 

/**
 * @author Dejan
 * @since  Sep 24, 2018
 */

namespace App\Models\Message;

use Cmgmyr\Messenger\Models\Thread;

class MessageThread extends Thread {

    /**
     * Message Thread Type
     */
    const TYPE_GLOBAL   = 1;
    const TYPE_TRIBE    = 2;
    const TYPE_PROJECT  = 3;

    public static function getAllLatestByType($type, $ref_id) {
        return static::latest('updated_at')
            ->where('type', '=', $type)
            ->where('ref_id', '=', $ref_id);
    }

    public static function getAllLatestByTribe($ref_id) {
        return MessageThread::getAllLatestByType(MessageThread::TYPE_TRIBE, $ref_id);
    }

    public static function getAllLatestByProject($ref_id) {
        return MessageThread::getAllLatestByType(MessageThread::TYPE_PROJECT, $ref_id);
    }
}