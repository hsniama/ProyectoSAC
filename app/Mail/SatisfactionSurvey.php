<?php

namespace App\Mail;

use App\Models\Diagnosis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SatisfactionSurvey extends Mailable
{
    use Queueable, SerializesModels;

    public $diagnosis;
    public $surveyUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Diagnosis $diagnosis, $surveyUrl)
    {
        $this->diagnosis = $diagnosis;
        $this->surveyUrl = $surveyUrl;
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Encuesta de Satisfacción - Oromed',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            // markdown: 'emails.email_survey',
            view: 'emails.email_survey',
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
