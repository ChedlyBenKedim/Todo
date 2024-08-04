<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;

class TaskNotification extends Notification
{
    use Queueable;

    protected $task;
    protected $message;

    public function __construct(Task $task, $message)
    {
        $this->task = $task;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notification de tâche')
            ->line($this->message)
            ->action('Voir la tâche', url('/tasks/' . $this->task->id))
            ->line('Merci d\'utiliser notre application!');
    }
}
