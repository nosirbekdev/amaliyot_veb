@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <div class="container mx-auto p-6 max-w-4xl bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-900 mb-4">{{ $project->name }}</h2>

        <!-- Tashkilotchi -->
        <div class="mb-6">
            <span class="text-sm font-medium text-gray-500">Tashkilotchi:</span>
            <span class="text-lg text-gray-800">
                @if($project->organization)
                    {{ $project->organization }}
                @else
                    Tashkilotchi belgilanmagan
                @endif
            </span>
        </div>

        <!-- Loyiha tavsifi -->
        <p class="text-lg text-gray-700 mb-6">{{ $project->description }}</p>

        <!-- Loyiha sanalari -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div class="flex flex-col">
                <span class="text-sm font-medium text-gray-500">Boshlanish sanasi:</span>
                <span class="text-lg text-gray-800">{{ $project->start_date }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-sm font-medium text-gray-500">Tugash sanasi:</span>
                <span class="text-lg text-gray-800">{{ $project->end_date }}</span>
            </div>
        </div>

        <!-- Payment Information -->
        @if($project->payment)
        <div class="mb-6">
                <span class="text-sm font-medium text-gray-500">To'lov miqdori:</span>
                <span class="text-lg text-gray-800">${{ number_format($project->payment, 2) }}</span>
            </div>
        @else
            <div class="mb-6">
                <span class="text-lg font-medium text-gray-500">To'lov miqdori:</span>
                <span class="text-sm text-gray-800">Belgilangan emas</span>
            </div>
        @endif

        <!-- Faylni ko'rsatish yoki yuklab olish -->
        @if($project->file_path)
            <div class="mt-4">
                <a href="{{ asset('storage/' . $project->file_path) }}" class="text-blue-600 hover:text-blue-800" target="_blank">
                    Faylni ko'rish yoki yuklab olish
                </a>
            </div>
        @endif

        <!-- Tasavvur (action) tugmalari -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('projects.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Bosh sahifaga qaytish</a>

            <div class="space-x-1">
                @if(auth()->user()->isAdmin())
                    <!-- Loyiha tahrirlash tugmasi -->
                    <a href="{{ route('projects.edit', $project->id) }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                        Loyiha tahrirlash
                    </a>

                    <!-- Loyiha o'chirish tugmasi -->
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Loyihani o\'chirishni tasdiqlaysizmi?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
                            Loyiha o'chirish
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
