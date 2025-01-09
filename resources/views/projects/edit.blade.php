@extends('layouts.app')

@section('title', 'Loyihani tahrirlash: ' . $project->name)

@section('content')
    <div class="container mx-auto p-6 max-w-4xl bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-900 mb-4">Loyihani tahrirlash: {{ $project->name }}</h2>

        <!-- Xatoliklarni ko'rsatish -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Loyihaning nomi</label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}"
                       class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Loyihaning tavsifi</label>
                <textarea name="description" id="description"
                          class="mt-1 p-2 w-full border border-gray-300 rounded-lg">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Boshlanish sanasi</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tugash sanasi</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
                </div>
            </div>

            <!-- Payment field -->
            <div class="mb-4">
                <label for="payment" class="block text-sm font-medium text-gray-700">To'lov miqdori</label>
                <div class="flex items-center border border-gray-300 rounded-lg">
                    <span class="px-3 text-gray-700">$</span>
                    <input type="number" name="payment" id="payment" value="{{ old('payment', $project->payment) }}"
                        class="mt-1 p-2 w-full border-0 rounded-lg" step="0.01" placeholder="0.00" required>
                </div>
            </div>

            <!-- Add a dropdown for selecting the organizer -->
            <div class="mb-4">
                <label for="organization" class="text-gray-700">Tashkilot nomi</label>
                <input type="text" name="organization" id="organization" value="{{ old('organization', $project->organization ?? '') }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm @error('organization') border-red-500 @enderror"
                    required>
                @error('organization')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


            <!-- File Upload -->
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Loyihaga fayl yuklash (ixtiyoriy)</label>
                <input type="file" name="file" id="file" class="mt-1 p-2 w-full border border-gray-300 rounded-lg">
                @if($project->file_path)
                    <div class="mt-2 text-sm text-gray-600">
                        Mavjud fayl: <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800">Ko'rish yoki yuklab olish</a>
                    </div>
                @endif
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('projects.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Bosh sahifaga qaytish</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Yangilash</button>
            </div>
        </form>
    </div>
@endsection
