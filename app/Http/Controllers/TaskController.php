<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendTaskNotification; // Import the Job
use App\Notifications\TaskUpdatedNotification;
use App\Notifications\TaskAssignedNotification;
use App\Notifications\TaskCompletedNotification;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;
        Log::info('Récupération des tâches de l\'utilisateur connecté', ['user_id' => auth()->id(), 'timestamp' => now()]);
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        $user = $task->user;
        Notification::send($user, new TaskAssignedNotification($task));

        // Dispatch SendTaskNotification job to RabbitMQ
        SendTaskNotification::dispatch($task)->onQueue('notifications');

        Log::info('Tâche créée avec succès', [
            'task_id' => $task->id,
            'user_id' => $task->user_id,
            'timestamp' => now()
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
    }

    public function show(Task $task)
    {
        Log::info('Affichage de la tâche', ['task_id' => $task->id, 'timestamp' => now()]);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas l\'autorisation de modifier cette tâche.');
        }

        $users = User::all();
        Log::info('Affichage du formulaire d\'édition de tâche', ['task_id' => $task->id, 'timestamp' => now()]);
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas l\'autorisation de modifier cette tâche.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $user = $task->user;
        Notification::send($user, new TaskUpdatedNotification($task));

        // Dispatch SendTaskNotification job to RabbitMQ
        SendTaskNotification::dispatch($task)->onQueue('notifications');
        Log::info('Tâche mise à jour avec succès', [
            'task_id' => $task->id,
            'user_id' => $task->user_id,
            'timestamp' => now()
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche modifiée avec succès.');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas l\'autorisation de supprimer cette tâche.');
        }

        $task->delete();

        Log::info('Tâche supprimée avec succès', [
            'task_id' => $task->id,
            'user_id' => $task->user_id,
            'timestamp' => now()
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
    }

    public function markAsCompleted($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'completed';
        $task->completed_at = now();
        $task->save();

        $user = $task->user;
        Notification::send($user, new TaskCompletedNotification($task));

        // Dispatch SendTaskNotification job to RabbitMQ
        SendTaskNotification::dispatch($task)->onQueue('notifications');

        Log::info('Tâche marquée comme complétée', [
            'task_id' => $task->id,
            'user_id' => $task->user_id,
            'timestamp' => now()
        ]);

        return redirect()->route('tasks.index')->with('success', 'La tâche a été marquée comme complétée.');
    }

    public function create()
    {
        $users = User::all();
        Log::info('Affichage du formulaire de création de tâche', ['timestamp' => now()]);
        return view('tasks.create', compact('users'));
    }
}
