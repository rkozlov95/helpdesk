<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentsShipped extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $comment;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($comment, $url)
    {
        $this->comment = $comment;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Comment INFO')
            ->view('mail.comment_info');
    }
}
