<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageReceived extends Notification
{
    use Queueable;

    /**
     * sender
     */
    protected $sender;

    /**
     * receiver
     */
    protected $receiver;

    /**
     * notification message
     */
    protected $message = 'You have received the message from User "?"';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sender, $receiver)
    {
        //
        $this->sender = $sender;
        $this->receiver = $receiver;
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
            'sender_id'  => $this->sender->id,
            'receiver_id' => $this->receiver->id,
        ];
    }

    /**
     * Get Message
     */
    public function toString() {
        $sender  = $this->sender;
        $receiver = $this->receiver;

        return str_replace_array('?', [$sender->profile->name], $this->message);
    }
}
