<?php

namespace App\Mail;

use App\Models\BookComments;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookCommentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param BookComments $comment
     */
    public function __construct(public BookComments $comment)
    {

    }

    /**
     * @return BookCommentMail
     */
    public function build()
    {
        return $this->subject('BookCommentMail')
            ->view('emails.comment-message')
            ->with('comment', $this->comment);
    }
}
