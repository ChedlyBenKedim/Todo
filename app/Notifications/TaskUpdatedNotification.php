<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;

class TaskUpdatedNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Tâche Modifiée')
            ->line('La tâche suivante a été modifiée : ' . $this->task->title)
            ->action('Voir la tâche', url('/tasks/' . $this->task->id))
            ->line('Merci d\'utiliser notre application!');
    }
}
