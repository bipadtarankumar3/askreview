<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignupNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientType; // 'USER' or 'ADMIN'
    public $data;
    public $customSubject;

    /**
     * Create a new message instance.
     *
     * @param string $recipientType 'USER' or 'ADMIN'
     * @param array $data Email data
     * @param string|null $customSubject Optional custom subject
     */
    public function __construct($recipientType, $data, $customSubject = null)
    {
        $this->recipientType = $recipientType;
        $this->data = $data;
        $this->customSubject = $customSubject;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $businessName = !empty($this->data['name']) ? $this->data['name'] : 'AskReview';
        $defaultSubject = ($this->recipientType === 'ADMIN')
            ? "New User Registration Alert: {$businessName}"
            : "Welcome to AskReview - Your 7-Day Free Trial is Active!";

        return new Envelope(
            subject: $this->customSubject ?: $defaultSubject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $viewName = ($this->recipientType === 'ADMIN') 
            ? 'mail.admin_new_user_alert' 
            : 'mail.user_signup_welcome';

        return new Content(
            view: $viewName,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
