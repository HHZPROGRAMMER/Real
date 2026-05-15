<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Kodni saqlash uchun public o'zgaruvchi
    public $code;

    // 2. Kontrollerdan kodni qabul qilib olamiz
    public function __construct($code)
    {
        $this->code = $code;
    }

    // 3. Email mavzusini (subject) o'zgartiramiz
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Trello - Tasdiqlash kodi',
        );
    }

    // 4. Qaysi view faylini ishlatishini ko'rsatamiz
    public function content(): Content
    {
        return new Content(
            text: 'emails.otp', // Bu yerda ham text deb o'zgartiring
            with: [
                'code' => $this->code,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}