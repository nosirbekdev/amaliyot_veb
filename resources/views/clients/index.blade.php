@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-4 text-gray-700">
        <a href="#" class="text-sm font-medium">Dashboard</a>
        <span class="text-sm">&#x3e;</span>
        <a href="#" class="text-sm font-medium">Clients</a>
    </div>

    <!-- Header -->
    <h1 class="text-4xl font-semibold mb-2 font-sans">OcOO "Energi.kg"</h1>
    <div class="flex justify-evenly mx-auto gap-3">
    <!-- Box 1 -->
    <div class="bg-[#F8FAFC] p-6 rounded-lg shadow-md flex-1">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="flex flex-col">
                <p class="text-sm text-gray-500">Address:</p>
                <p class="font-medium">12/04/2021</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm text-gray-500">Date added:</p>
                <p class="font-medium">12/04/2021</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm text-gray-500">Contacts:</p>
                <p class="font-medium">996545423</p>
            </div>
            <div class="flex flex-col">
                <p class="text-sm text-gray-500">Status:</p>
                <p class="font-medium text-green-600">Active</p>
            </div>
        </div>
    </div>

    <!-- Box 2 -->
    <div class="bg-[#F8FAFC] p-6 rounded-lg shadow-md flex-1">
        <div class="grid grid-cols-1 gap-4 mb-6">
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis risus, sed arcu rhoncus suspendisse.
            </p>
        </div>
    </div>
</div>


    <!-- Sections -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mt-6">
    <!-- Projects (70%) -->
    <div class="bg-[#F8FAFC] p-4 rounded-lg shadow-md md:col-span-3">
        <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold mb-3">Projects</h2>
        <!-- export button -->
        <a href="{{ route('projects.export') }}" class="hover:text-[#1F509A] text-[#441752]">
            <i class="fas fa-file-export"></i> Excel
        </a>


        </div>
        <ul class="space-y-2">
        @foreach($projects as $project)
            <li class="grid grid-cols-4 items-center py-2 bg-[#E0E4EA] px-2 rounded-lg">
                <a href="{{ route('tasks.show', ['project_id' => $project->id]) }}" class="col-span-1 text-gray-800 font-medium">{{ $project->name }}</a>
                <div class="col-span-1 text-sm text-gray-500 flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                </div>
                <div class="col-span-1 text-sm text-gray-500 flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                </div>
                <span class="col-span-1 flex items-center gap-2 text-gray-800">
                    <i class="fas fa-users"></i> {{ $project->organization }}
                </span>
            </li>
        @endforeach
        </ul>


    </div>

    <!-- Tasks (30%) -->
    <div class="bg-[#F8FAFC] p-4 rounded-lg shadow-md md:col-span-2">
        <h2 class="text-lg font-semibold mb-3">Tasks</h2>
        <ul class="space-y-2">
            <li class="py-2 bg-[#E0E4EA] px-2 rounded-lg">
                <span>Jump to actions</span>
                <div class="text-sm text-gray-500"><i class="fas fa-calendar-alt"></i> 12/04/2021</div>
            </li>
            <li class="py-2 bg-[#E0E4EA] px-2 rounded-lg">
                <span>Notifications</span>
                <div class="text-sm text-gray-500"><i class="fas fa-calendar-alt"></i> 12/04/2021</div>
            </li>
            <li class="py-2 bg-[#E0E4EA] px-2 rounded-lg">
                <span>Priorities</span>
                <div class="text-sm text-gray-500"><i class="fas fa-calendar-alt"></i> 12/04/2021</div>
            </li>
        </ul>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mt-6">
    <!-- Payments (70%) -->
    <div class="bg-[#F8FAFC] p-4 rounded-lg shadow-md md:col-span-3">
        <h2 class="text-lg font-semibold mb-3">Payments</h2>

        <ul class="w-full space-y-2">
            <!-- Payment 1 -->
             @foreach($projects as $invoice)
             <li class="grid grid-cols-4 items-center py-4 bg-[#E0E4EA] px-4 rounded-lg">
                <span class="col-span-1 text-gray-800 font-medium">{{ $invoice->name }}</span>
                <div class="col-span-1 text-sm text-gray-500 flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($invoice->start_date)->format('d/m/Y') }}
                </div>
                <div class="col-span-1 text-sm text-gray-500 flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($invoice->end_date)->format('d/m/Y') }}
                </div>
                <span class="col-span-1 text-sm font-medium text-gray-700">
                    <i class="fas fa-dollar-sign"></i> {{ $invoice->payment }}
                </span>
            </li>
            @endforeach
        </ul>


    </div>

    <!-- Documents (30%) -->
    <div class="bg-[#F8FAFC] p-4 rounded-lg shadow-md md:col-span-2">
        <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold mb-3">Documents</h2>
        <a href="#" class="hover:text-[#1F509A] text-[#441752]">
                <!-- ikonka -->
                <i class="fas fa-file-export"></i>
            </a>
        </div>
        <ul class="space-y-2">
            @foreach($projects as $project)
                @if($project->file_path) <!-- Fayl mavjud bo'lsa -->
                    <li class="py-2 bg-[#E0E4EA] px-2 rounded-lg flex justify-between items-center">
                        <div>
                            <span>{{ $project->name }}</span> <!-- Loyiha nomini ko'rsatish -->
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-calendar-alt"></i> {{ $project->start_date }} <!-- Boshlanish sanasini ko'rsatish -->
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $project->file_path) }}" class="hover:text-[#1F509A] text-[#441752]">
                            <i class="fas fa-file-download text-2xl"></i> <!-- Faylni yuklab olish ikonkasi -->
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>

</div>
@endsection
