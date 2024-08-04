<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Notifications\TaskDueNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class SendDueTaskNotifications extends Command
{
    protected $signature = 'tasks:send-due-notifications';
    protected $description = 'Envoyer des notifications pour les tâches dues';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tasks = Task::where('due_date', '<=', Carbon::now())
            ->where('status', 'pending')
            ->get();

        foreach ($tasks as $task) {
            $user = $task->user;
            Notification::send($user, new TaskDueNotification($task));
        }

        $this->info('Notifications de tâches dues envoyées avec succès.');
    }
}
