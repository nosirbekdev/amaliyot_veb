@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Edit Task</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div class="form-group">
                <label for="title" class="text-sm text-gray-700">Task Title</label>
                <input type="text" id="title" name="title" class="w-full p-2 border rounded" value="{{ $task->title }}" required>
            </div>
            <div class="form-group">
                <label for="participant" class="text-sm text-gray-700">Participant</label>
                <input type="text" id="participant" name="participant" class="w-full p-2 border rounded" value="{{ $task->participant }}" required>
            </div>
            <div class="form-group">
                <label for="priority" class="text-sm text-gray-700">Priority</label>
                <select id="priority" name="priority" class="w-full p-2 border rounded" required>
                    <option value="High" {{ $task->priority === 'High' ? 'selected' : '' }}>High</option>
                    <option value="Medium" {{ $task->priority === 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Low" {{ $task->priority === 'Low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status" class="text-sm text-gray-700">Status</label>
                <select id="status" name="status" class="w-full p-2 border rounded" required>
                    <option value="to_do" {{ $task->status === 'to_do' ? 'selected' : '' }}>To Do</option>
                    <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="closed" {{ $task->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    <option value="frozen" {{ $task->status === 'frozen' ? 'selected' : '' }}>Frozen</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date_added" class="text-sm text-gray-700">Date Added</label>
                <input type="date" id="date_added" name="date_added" class="w-full p-2 border rounded" value="{{ $task->date_added }}" required>
            </div>
            <div class="form-group">
                <label for="deadline" class="text-sm text-gray-700">Deadline</label>
                <input type="date" id="deadline" name="deadline" class="w-full p-2 border rounded" value="{{ $task->deadline }}" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Update Task</button>
        </div>
    </form>
</div>
@endsection
