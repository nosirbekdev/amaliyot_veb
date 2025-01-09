@extends('layouts.app')

@section('title', 'Loyiha qo\'shish')

@section('content')
    <div class="container mx-auto p-6 max-w-4xl bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-900 mb-4">Yangi loyiha qo'shish</h2>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="text-gray-700">Loyiha nomi</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="text-gray-700">Loyiha ta'rifi</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-4 py-2 border rounded-lg shadow-sm @error('description') border-red-500 @enderror"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="start_date" class="text-gray-700">Boshlanish sanasi</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm @error('start_date') border-red-500 @enderror"
                       required>
                @error('start_date')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="end_date" class="text-gray-700">Tugash sanasi</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm @error('end_date') border-red-500 @enderror"
                       required>
                @error('end_date')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="payment" class="text-gray-700">To'lov miqdori</label>
                <input type="number" name="payment" id="payment" value="{{ old('payment') }}" step="0.01" placeholder="0.00"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm @error('payment') border-red-500 @enderror"
                       required>
                @error('payment')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="organization" class="text-gray-700">Tashkilot nomi</label>
                <input type="text" name="organization" id="organization" value="{{ old('organization') }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm @error('organization') border-red-500 @enderror"
                    required>
                @error('organization')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <label for="file" class="text-gray-700">Loyiha fayli (PDF yoki DOC)</label>
                <input type="file" name="file" id="file" accept=".pdf,.doc,.docx"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm @error('file') border-red-500 @enderror">
                @error('file')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700">Qo'shish</button>
        </form>
    </div>
@endsection
