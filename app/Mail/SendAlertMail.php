<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAlertMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $name;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($email,$name,$subject)
    {   
        $this->email = $email;
        $this->name = $name;
        $this->subject = $subject;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
            from: 'User query alert',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'Email.queryalertmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->markdown('Email.queryalertmail')->with([
            'email' => $this->email,
            'name' => $this->name,
            'subject' => $this->subject
        ]);        
    }
}
