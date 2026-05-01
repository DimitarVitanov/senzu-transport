<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuoteRequestConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quote)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We received your quote request — Senzu Transport',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quote-confirmation',
        );
    }
}
