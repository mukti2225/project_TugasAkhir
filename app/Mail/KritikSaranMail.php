<?php

namespace App\Mail;

use App\Models\KritikSaran;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KritikSaranMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public KritikSaran $kritikSaran)
    {
        $this->kritikSaran = $kritikSaran;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Kritik & Saran] ' . ucfirst($this->kritikSaran->subjek) . ' dari ' . $this->kritikSaran->nama,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(view: 'emails.kritik-saran');
    }

    public function build()
    {
        return $this
            ->subject('Pesan Kritik & Saran Baru')
            ->replyTo(
                $this->kritikSaran->email,
                $this->kritikSaran->nama
            )
            ->view('emails.kritik-saran');
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
}
