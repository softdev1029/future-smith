<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectJoinRequestSent extends Notification
{
    use Queueable;

    protected $project;

    protected $sender;

    protected $message = 'You have received the joining request for Project "?" from User "?"';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project, $sender)
    {
        //
        $this->project  = $project;
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
            'project_id'  => $this->project->id,
            'sender_id' => $this->sender->id,
        ];
    }

    /**
     * Get Message
     */
    public function toString() {
        $project  = $this->project;
        $sender = $this->sender;

        return str_replace_array('?', [$project->title, $sender->profile->name], $this->message);
    }
}
