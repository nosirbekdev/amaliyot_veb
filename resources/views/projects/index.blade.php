@extends('layouts.app')

@section('title', 'Barcha loyihalar')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Barcha loyihalar</h2>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 mb-4 inline-block">
                    Yangi loyiha qo'shish
                </a>
            @endif
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <ul class="divide-y divide-gray-200">
                @foreach($projects as $project)
                    <li class="py-4 px-6 flex items-center hover:bg-gray-50 transition duration-200">
                        <div class="flex-1">
                            <p class="text-xl font-medium text-gray-800">{{ $project->name }}</p>
                            <p class="text-gray-600 text-sm">
                                {{-- Description qismini kesish --}}
                                {{ Str::limit($project->description, 150) }}
                            </p>
                            <div class="mt-2 text-gray-500 text-sm">
                                <span><strong>Boshlanish sanasi:</strong> {{ $project->start_date }}</span> |
                                <span><strong>Tugash sanasi:</strong> {{ $project->end_date }}</span>
                            </div>
                            {{-- To'lov miqdorini ko'rsatish --}}
                            <div class="mt-2 text-gray-500 text-sm">
                                <span><strong>To'lov miqdori:</strong>
                                    @if($project->payment)
                                        ${{ number_format($project->payment, 2) }}
                                    @else
                                        Noma'lum
                                    @endif
                                </span>
                            </div>
                            {{-- Tashkilotchini ko'rsatish --}}
                            <div class="mt-2 text-gray-500 text-sm">
                                <span><strong>Tashkilotchi:</strong>
                                    @if($project->organization)
                                        {{ $project->organization }}
                                    @else
                                        Tashkilotchi belgilanmagan
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <a href="{{ route('projects.show', $project->id) }}" class="text-blue-600 hover:text-blue-700 text-sm">
                                Batafsil
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
