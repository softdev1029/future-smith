<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Tribe;
use App\Models\User;

class TribeJoinRequestReceived extends Notification
{
    use Queueable;

    protected $tribe;

    protected $sender;

    protected $message = 'You have received the joining request for Tribe "?" from User "?"';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tribe, $sender)
    {
        //
        $this->tribe  = $tribe;
        $this->sender = $sender;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message'   => $this->toString(),
            'tribe_id'  => $this->tribe->id,
            'sender_id' => $this->sender->id,
        ];
    }

    /**
     * Get Message
     */
    public function toString() {
        $tribe  = $this->tribe;
        $sender = $this->sender;

        return str_replace_array('?', [$tribe->title, $sender->profile->name], $this->message);
    }
}
