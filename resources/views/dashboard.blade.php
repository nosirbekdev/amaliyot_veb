@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <a href="/" class="items-center text-gray-600 mb-4 inline-block">
        <i class="fas fa-arrow-left"></i> Ortga
    </a>

    <!-- Projects Cards -->
    <div class="flex flex-wrap -mx-4">
        @forelse ($projects as $project)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-4">
                <!-- Project Card -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-700">{{ $project->name }}</h3>
                    <p class="text-sm text-gray-500 mt-2">
                        Organization: <span class="font-medium text-gray-700">{{ $project->organization }}</span>
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        Start Date: <span class="font-medium text-gray-700">{{ $project->start_date }}</span>
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        End Date: <span class="font-medium text-gray-700">{{ $project->end_date }}</span>
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('projects.show', $project->id) }}" class="text-blue-600 hover:text-blue-800">View Project</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600">No projects available.</p>
        @endforelse
    </div>
@endsection
