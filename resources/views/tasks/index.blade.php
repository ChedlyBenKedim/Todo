@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Alert for user registration -->
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Note:</strong> Vous devez inscrire au moins un utilisateur pour créer des tâches.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Liste des Tâches</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-lg">Ajouter une Tâche</a>
        </div>

        <!-- Tasks List -->
        <div class="row">
            @if ($tasks && $tasks->count())
                @foreach ($tasks->sortBy('id') as $task)
                    <div class="col-md-6 mb-4">
                        <div class="card border-{{ $task->status === 'completed' ? 'success' : 'warning' }} shadow-lg rounded">
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p class="card-text">{{ $task->description }}</p>
                                <p class="card-text">
                                    Status : <span class="badge bg-{{ $task->status === 'completed' ? 'success' : 'warning' }}">{{ ucfirst($task->status) }}</span>
                                </p>
                                @if ($task->completed_at)
                                    <p class="card-text"><small class="text-muted">Complété à {{ $task->completed_at }}</small></p>
                                @endif
                                <div class="d-flex justify-content-end mt-3">
                                    @if ($task->status === 'pending')
                                        <form action="{{ route('tasks.markAsCompleted', $task->id) }}" method="POST" class="me-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-info btn-sm rounded-pill">Marquer comme Complète</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm rounded-pill me-2">Modifier</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Aucune tâche trouvée.</strong>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
