<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectStatusUpdatedNotification extends Notification
{
    use Queueable;

    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function via(object $notifiable): array
    {
        // You can also add 'mail' here if you want email notifications too
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $statusLabel = Project::STATUS[$this->project->status] ?? 'Unknown';
        return [
            'project_id'   => $this->project->id,
            'project_name' => $this->project->name,
            'status'       => $statusLabel,
            'message'      => "Your project '{$this->project->name}' status has been updated to '{$statusLabel}'.",
        ];
    }
}
