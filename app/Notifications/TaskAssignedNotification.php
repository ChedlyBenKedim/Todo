<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Créez une nouvelle notification d'assignation de tâche.
     *
     * @param Task $task
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Obtenez les canaux de notification que la notification doit utiliser.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Obtenez le message de notification pour la notification par e-mail.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle Tâche Assignée')
            ->line('Vous avez été assigné à une nouvelle tâche.')
            ->action('Voir la Tâche', url('/tasks/' . $this->task->id))
            ->line('Merci d\'utiliser notre application!');
    }
}
