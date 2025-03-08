<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $token;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Đặt lại mật khẩu của bạn',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.templatemail',
            with: [
                'resetLink' => url('/reset-password/' . $this->token),
                'email' => $this->email,
            ],
        );
    }
}


