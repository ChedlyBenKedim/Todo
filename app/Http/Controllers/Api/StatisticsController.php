<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Task;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function daily(Request $request)
    {
        $date = $request->input('date', Carbon::now()->format('Y-m-d'));

        try {
            $tasks = Task::whereDate('created_at', $date)->get();
            $completedTasks = $tasks->where('status', 'completed');
            $totalTasks = $tasks->count();
            $completionRate = $totalTasks > 0 ? ($completedTasks->count() / $totalTasks) * 100 : 0;
            $averageCompletionTime = $completedTasks->avg(function ($task) {
                $created_at = Carbon::parse($task->created_at);
                $completed_at = Carbon::parse($task->completed_at);
                return $completed_at->diffInHours($created_at);
            });

            Log::info('Statistiques quotidiennes récupérées', [
                'date' => $date,
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks->count(),
                'completion_rate' => $completionRate,
                'average_completion_time' => $averageCompletionTime,
            ]);

            return response()->json([
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks->count(),
                'completion_rate' => $completionRate,
                'average_completion_time' => $averageCompletionTime,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des statistiques quotidiennes', [
                'date' => $date,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => 'Erreur lors de la récupération des statistiques quotidiennes.',
            ], 500);
        }
    }

    public function weekly(Request $request)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        try {
            $tasks = Task::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
            $completedTasks = $tasks->where('status', 'completed');
            $totalTasks = $tasks->count();
            $completionRate = $totalTasks > 0 ? ($completedTasks->count() / $totalTasks) * 100 : 0;
            $averageCompletionTime = $completedTasks->avg(function ($task) {
                $created_at = Carbon::parse($task->created_at);
                $completed_at = Carbon::parse($task->completed_at);
                return $completed_at->diffInHours($created_at);
            });

            Log::info('Statistiques hebdomadaires récupérées', [
                'start_date' => $startOfWeek->toDateString(),
                'end_date' => $endOfWeek->toDateString(),
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks->count(),
                'completion_rate' => $completionRate,
                'average_completion_time' => $averageCompletionTime,
            ]);

            return response()->json([
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks->count(),
                'completion_rate' => $completionRate,
                'average_completion_time' => $averageCompletionTime,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des statistiques hebdomadaires', [
                'start_date' => $startOfWeek->toDateString(),
                'end_date' => $endOfWeek->toDateString(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => 'Erreur lors de la récupération des statistiques hebdomadaires.',
            ], 500);
        }
    }

    public function monthly(Request $request)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        try {
            $tasks = Task::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
            $completedTasks = $tasks->where('status', 'completed');
            $totalTasks = $tasks->count();
            $completionRate = $totalTasks > 0 ? ($completedTasks->count() / $totalTasks) * 100 : 0;
            $averageCompletionTime = $completedTasks->avg(function ($task) {
                $created_at = Carbon::parse($task->created_at);
                $completed_at = Carbon::parse($task->completed_at);
                return $completed_at->diffInHours($created_at);
            });

            Log::info('Statistiques mensuelles récupérées', [
                'start_date' => $startOfMonth->toDateString(),
                'end_date' => $endOfMonth->toDateString(),
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks->count(),
                'completion_rate' => $completionRate,
                'average_completion_time' => $averageCompletionTime,
            ]);

            return response()->json([
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks->count(),
                'completion_rate' => $completionRate,
                'average_completion_time' => $averageCompletionTime,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des statistiques mensuelles', [
                'start_date' => $startOfMonth->toDateString(),
                'end_date' => $endOfMonth->toDateString(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => 'Erreur lors de la récupération des statistiques mensuelles.',
            ], 500);
        }
    }
}
