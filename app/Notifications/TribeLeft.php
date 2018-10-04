<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TribeLeft extends Notification
{
    use Queueable;

    protected $tribe;

    protected $user;

    protected $message = 'You have left the troject "?": user (?)';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tribe, $user)
    {
        //
        $this->tribe = $tribe;
        $this->user = $user;
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
            'user_id' => $this->user->id,
        ];
    }

    /**
     * Get Message
     */
    public function toString() {
        $tribe  = $this->tribe;
        $user = $this->user;

        return str_replace_array('?', [$tribe->title, $user->profile->name], $this->message);
    }
}
