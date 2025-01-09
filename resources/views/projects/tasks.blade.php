@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6"></div>
            <a href="/" class="items-center text-gray-600 mb-4 inline-block">
                <i class="fas fa-arrow-left"></i> Ortga
            </a>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-700">AAA</h3>
                <p class="text-sm text-gray-500 mt-2">Status: <span class="font-medium text-gray-700">VVV</span></p>
                <p class="text-sm text-gray-500 mt-2">Due Date: <span class="font-medium text-gray-700">CCC</span></p>

                <div class="mt-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800">View Project</a>
                </div>
            </div>
@endsection

