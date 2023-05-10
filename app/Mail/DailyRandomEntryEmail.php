<?php

namespace App\Mail;

use App\Models\JournalEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyRandomEntryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $entries;

    /**
     * Create a new message instance.
     */
    public function __construct($entries)
    {
        $this->entries = $entries;
    }

    // public function build()
    // {
    //     return $this->markdown('emails.randomentries')
    //         ->subject('Daily Random Entries Email')
    //         ->with([
    //             'entries' => $this->entries,
    //         ]);
    // }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Random Entries Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.randomentries',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
