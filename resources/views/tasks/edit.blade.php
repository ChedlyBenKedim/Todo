@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">{{ isset($task) ? 'Modifier' : 'Ajouter' }} une Tâche</h1>
        <form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
            @csrf
            @if (isset($task))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $task->title ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description">{{ old('description', $task->description ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="pending" {{ old('status', $task->status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status', $task->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">Utilisateur</label>
                <select class="form-control" name="user_id" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $task->user_id ?? '') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($task) ? 'Modifier' : 'Ajouter' }} la Tâche</button>
        </form>
    </div>
@endsection
