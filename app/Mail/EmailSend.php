<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\EmailTemplate;

class EmailSend extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $template_id;
    public $content_params;
    public $subject_params;

    public $from_email;
    public $from_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template_id, $content_params = [], $subject_params = [], $from_email = null, $from_name = null)
    {
        //
        $this->template_id      = $template_id;
        $this->content_params   = $content_params;
        $this->subject_params   = $subject_params;

        $this->from_email = $from_email;
        $this->from_name  = $from_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $subject = EmailTemplate::getSubject($this->template_id, $this->subject_params);

        if ($this->from_email && $this->from_name)
            return $this->from($this->from_email, $this->from_name)
                        ->subject($this->subject)
                        ->view('emails.' . $this->template_id, $this->content_params);
        else
            return $this->subject($this->subject)
                        ->view('emails.' . $this->template_id, $this->content_params);
    }
}
