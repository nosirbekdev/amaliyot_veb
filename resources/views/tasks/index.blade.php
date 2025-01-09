@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="container mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-2 text-gray-700">
        <a href="#" class="text-sm font-medium">Dashboard</a>
        <span class="text-sm">&#x3e;</span>
        <a href="#" class="text-sm font-medium">Tasks</a>
    </div>

    <div class="bg-gray-100 p-6 rounded-lg">
        <h1 class="text-xl font-semibold text-gray-800 mb-3">Project name</h1>
        <div class="grid grid-cols-12 gap-4">
            <!-- Project Info Section -->
            <div class="col-span-4 bg-white p-4 rounded-lg shadow">
                <div class=" space-y-2">

                @php
                    $task = $tasks['to_do']->first();  // Get the first task from the to_do collection
                @endphp
                @if ($task)
                    <p class="text-sm text-gray-600">
                        <span class="font-medium">Date added:</span> {{ \Carbon\Carbon::parse($task->date_added)->format('d/m/Y') }}
                    </p>

                    <p class="text-sm text-gray-600">
                        <span class="font-medium">Deadline:</span> {{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}
                    </p>

                    <p class="text-sm text-gray-600">
                        <span class="font-medium">Participants:</span> {{ $task->participant }}
                    </p>
                @else
                    <p class="text-sm text-gray-600">No task available in "To Do".</p>
                @endif

                </div>
            </div>

            <!-- Description Section -->
            <div class="col-span-6 bg-white p-4 rounded-lg shadow flex ">
                <p class="text-sm text-gray-600">
                    A manager for internal use, designed for statistics accounting and task tracking.
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
            To do
            <a href="#" class="ml-auto text-[#FFFFFF] bg-[#67CB65] rounded-full w-6 h-6 flex items-center justify-center">+</a>
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
                </div>
            @empty
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <p class="text-sm text-gray-500">No tasks available.</p>
                </div>
            @endforelse
        </div>


    </div>

    <!--In Progress -->
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
                </div>
            @empty
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <p class="text-sm text-gray-500">No tasks available.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- close -->
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
@endsection
