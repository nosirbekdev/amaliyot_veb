@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="container mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-2 text-gray-700">
        <a href="{{ route('dashboard') }}" class="text-sm font-medium">Dashboard</a>
        <span class="text-sm">&#x3e;</span>
        <a href="{{ route('projects.index') }}" class="text-sm font-medium">Projects</a>
        <span class="text-sm">&#x3e;</span>
        <a href="#" class="text-sm font-medium">{{ $project->name }}</a>
    </div>

    <div class="bg-gray-100 p-6 rounded-lg">
        <h1 class="text-xl font-semibold text-gray-800 mb-3">{{ $project->name }}</h1>
        <div class="grid grid-cols-12 gap-4">
            <!-- Project Info Section -->
            <div class="col-span-4 bg-white p-4 rounded-lg shadow">
                <div class="space-y-2">
                    <p class="text-sm text-gray-600">
                        <span class="font-medium">Project Name:</span> {{ $project->name }}
                    </p>

                    <p class="text-sm text-gray-600">
                        <span class="font-medium">Start Date:</span> {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                    </p>

                    <p class="text-sm text-gray-600">
                        <span class="font-medium">Deadline:</span> {{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <!-- Description Section -->
            <div class="col-span-6 bg-white p-4 rounded-lg shadow flex ">
                <p class="text-sm text-gray-600">
                    {{ Str::limit($project->description, 150) }}
                </p>
            </div>

            <!-- Summary Section -->
            <div class="col-span-2 bg-white p-4 rounded-lg shadow">
                <div class="space-y-2">
                    <p class="text-sm text-gray-600 flex justify-between">
                        <span>All tasks:</span>
                        <span class="font-medium">{{ $tasks['to_do']->count() + $tasks['in_progress']->count() + $tasks['closed']->count() + $tasks['frozen']->count() }}</span>
                    </p>
                    <p class="text-sm text-gray-600 flex justify-between">
                        <span>Done:</span>
                        <span class="font-medium">{{ $tasks['closed']->count() }}</span>
                    </p>
                    <p class="text-sm text-gray-600 flex justify-between">
                        <span>Frozen:</span>
                        <span class="font-medium">{{ $tasks['frozen']->count() }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <!-- To Do -->
        <div class="">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                To Do
                @if (auth()->user() && auth()->user()->role === 'admin')
                    <!-- Show the Add Task button only for admins -->
                    <a href="#" class="ml-auto text-[#FFFFFF] bg-[#67CB65] rounded-full w-6 h-6 flex items-center justify-center" id="open-modal">+</a>
                @endif
            </h2>
            <div class="space-y-4 overflow-auto" style="max-height: 500px; scrollbar-width: none; -ms-overflow-style: none;">
                @forelse($tasks['to_do'] as $task)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <div class="flex items-center space-x-1">
                            <p class="font-medium text-gray-800">{{ $task->title }}</p>
                            <span class="badge px-1 rounded-lg text-white"
                                style="background-color: {{ $task->priority === 'High' ? '#FF0000' : ($task->priority === 'Medium' ? '#FF9533' : '#67CB65') }};">
                                {{ $task->priority }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500">Participant: {{ $task->participant }}</p>
                        <p class="text-sm text-gray-500">Date added: {{ $task->date_added }}</p>
                        @if (auth()->user() && auth()->user()->role === 'admin')
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline text-sm">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                        </form>
                    </div>
                    @endif
                    </div>
                @empty
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-sm text-gray-500">No tasks available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- In Progress -->
        <div class="">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                In Progress
            </h2>
            <div class="space-y-4 overflow-auto" style="max-height: 500px; scrollbar-width: none; -ms-overflow-style: none;">
                @forelse($tasks['in_progress'] as $task)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <div class="flex items-center space-x-1">
                            <p class="font-medium text-gray-800">{{ $task->title }}</p>
                            <span class="badge px-1 rounded-lg text-white"
                                style="background-color: {{ $task->priority === 'High' ? '#FF0000' : ($task->priority === 'Medium' ? '#FF9533' : '#67CB65') }};">
                                {{ $task->priority }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500">Participant: {{ $task->participant }}</p>
                        <p class="text-sm text-gray-500">Date added: {{ $task->date_added }}</p>
                        @if (auth()->user() && auth()->user()->role === 'admin')
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline text-sm">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                        </form>
                    </div>
                    @endif
                    </div>
                @empty
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-sm text-gray-500">No tasks available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Closed -->
        <div class="">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                Closed
            </h2>
            <div class="space-y-4 overflow-auto" style="max-height: 500px; scrollbar-width: none; -ms-overflow-style: none;">
                @forelse($tasks['closed'] as $task)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <div class="flex items-center space-x-1">
                            <p class="font-medium text-gray-800">{{ $task->title }}</p>
                            <span class="badge px-1 rounded-lg text-white"
                                style="background-color: {{ $task->priority === 'High' ? '#FF0000' : ($task->priority === 'Medium' ? '#FF9533' : '#67CB65') }};">
                                {{ $task->priority }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500">Participant: {{ $task->participant }}</p>
                        <p class="text-sm text-gray-500">Date added: {{ $task->date_added }}</p>
                        @if (auth()->user() && auth()->user()->role === 'admin')
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline text-sm">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                        </form>
                    </div>
                    @endif
                    </div>
                @empty
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-sm text-gray-500">No tasks available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Frozen -->
        <div class="">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                Frozen
            </h2>
            <div class="space-y-4 overflow-auto" style="max-height: 500px; scrollbar-width: none; -ms-overflow-style: none;">
                @forelse($tasks['frozen'] as $task)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <div class="flex items-center space-x-1">
                            <p class="font-medium text-gray-800">{{ $task->title }}</p>
                            <span class="badge px-1 rounded-lg text-white"
                                style="background-color: {{ $task->priority === 'High' ? '#FF0000' : ($task->priority === 'Medium' ? '#FF9533' : '#67CB65') }};">
                                {{ $task->priority }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500">Participant: {{ $task->participant }}</p>
                        <p class="text-sm text-gray-500">Date added: {{ $task->date_added }}</p>
                        @if (auth()->user() && auth()->user()->role === 'admin')
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline text-sm">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                        @endif
                    </div>
                @empty
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-sm text-gray-500">No tasks available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div id="add-task-modal" class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg max-w-lg w-full" onclick="event.stopPropagation()">
        <h2 class="text-xl font-semibold mb-4">Add New Task</h2>
        <form action="{{ route('tasks.store', $project->id) }}" method="POST">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <div class="space-y-4">
                <div class="form-group">
                    <label for="title" class="text-sm text-gray-700">Task Title</label>
                    <input type="text" id="title" name="title" class="w-full p-2 border rounded" required>
                </div>
                <div class="form-group">
                    <label for="participant" class="text-sm text-gray-700">Participant</label>
                    <input type="text" id="participant" name="participant" class="w-full p-2 border rounded" required>
                </div>
                <div class="form-group">
                    <label for="priority" class="text-sm text-gray-700">Priority</label>
                    <select id="priority" name="priority" class="w-full p-2 border rounded" required>
                        <option value="" disabled selected>Select Priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status" class="text-sm text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full p-2 border rounded
                    @error('status') border-red-500 @enderror" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="to_do">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="closed">Closed</option>
                        <option value="frozen">Frozen</option>
                    </select>
                    @error('status')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date_added" class="text-sm text-gray-700">Date Added</label>
                    <input type="date" id="date_added" name="date_added" class="w-full p-2 border rounded" required>
                </div>
                <div class="form-group">
                    <label for="deadline" class="text-sm text-gray-700">Deadline</label>
                    <input type="date" id="deadline" name="deadline" class="w-full p-2 border rounded" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Create Task</button>
                </div>
            </div>
        </form>

        <button class="mt-4 w-full bg-red-500 text-white p-2 rounded">Cancel</button>
    </div>
</div>

<script>
    // Open the modal when the "Add Task" button is clicked
    document.getElementById('open-modal').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default anchor behavior
        document.getElementById('add-task-modal').classList.remove('hidden'); // Show the modal
    });

    // Close the modal when the background (overlay) is clicked
    document.getElementById('add-task-modal').addEventListener('click', function (event) {
        if (event.target === this) {
            this.classList.add('hidden');
        }
    });
</script>
@endsection
