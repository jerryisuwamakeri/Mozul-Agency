<?php

namespace App\Mail;

use App\Models\BlogComment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public BlogComment $comment) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💬 New Blog Comment from ' . $this->comment->name,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.new_comment');
    }
}
