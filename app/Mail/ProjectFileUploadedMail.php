<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Project;
use App\Models\User;

class ProjectFileUploadedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $uploadedBy;

    /**
     * Create a new message instance.
     */
    public function __construct(Project $project, User $uploadedBy)
    {
        $this->project = $project;
        $this->uploadedBy = $uploadedBy;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New File Uploaded for Project: ' . $this->project->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.project_file_uploaded',
            with: [
                'project' => $this->project,
                'uploadedBy' => $this->uploadedBy,
            ],
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
}
