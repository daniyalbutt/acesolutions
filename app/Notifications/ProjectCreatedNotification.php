<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectCreatedNotification extends Notification
{
    use Queueable;

    protected $project;
    /**
     * Create a new notification instance.
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'project_id'   => $this->project->id,
            'project_name' => $this->project->name,
            'created_by'   => $this->project->user->name ?? 'Unknown User',
            'message'      => 'A new project has been created by ' . ($this->project->user->name ?? 'a user'),
            'created_at'   => now()->toDateTimeString(),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'project_id'   => $this->project->id,
            'project_name' => $this->project->name,
            'created_by'   => $this->project->user->name ?? 'Unknown User',
            'message'      => 'A new project has been created by ' . ($this->project->user->name ?? 'a user'),
            'created_at'   => now()->toDateTimeString(),
        ];
    }
}
