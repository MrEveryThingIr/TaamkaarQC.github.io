@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('content')
<div class="flex h-screen" x-data="{ activeSection: 'overview', openOrdererDropdown: null, openProjectDropdown: null, openDrawingPartDropdown: null }">
    <!-- Sidebar Navigation -->
    <aside class="flex flex-col w-64 text-white bg-gray-900">
        <!-- Logo and Slogan -->
        <div class="flex flex-col items-center p-6">
            <img src="{{ asset('images/taamkarbrand.png') }}" alt="Tamkaar Logo" class="w-auto h-20 mb-2">
            <h2 class="text-2xl font-extrabold text-green-400">تامکار تبلور توان ایرانی</h2>
        </div>

        <!-- Main Navigation Links -->
        <nav class="flex-1 px-4 mt-6 space-y-2">
            <!-- Main Dashboard Overview Link -->
            <button @click="activeSection = 'overview'" class="flex items-center p-2 text-sm font-medium text-gray-300 rounded hover:bg-gray-800 focus:outline-none"
                    :class="{ 'bg-gray-800': activeSection === 'overview' }">
                سیستم مدیریت پروژه‌ها
            </button>

            <!-- Orderers Section with Projects and DrawingParts -->
            <div class="mt-4">
                <!-- Orderers Dropdown -->
                <button @click="openOrdererDropdown = !openOrdererDropdown" class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-300 rounded hover:bg-gray-800 focus:outline-none">
                    <span>کارفرمایان</span>
                    <svg :class="{ 'transform rotate-180': openOrdererDropdown }" class="w-4 h-4 transition-transform">
                        <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Orderers Dropdown Content -->
                <div x-show="openOrdererDropdown" x-transition x-cloak class="ml-4 space-y-1">
                    <button @click="activeSection = 'createOrderer'" class="flex items-center p-2 text-sm font-medium text-gray-400 rounded hover:bg-gray-800 focus:outline-none"
                            :class="{ 'bg-gray-800': activeSection === 'createOrderer' }">
                        ثبت کارفرمای جدید
                    </button>

                    @foreach ($orderers as $orderer)
                        <button @click="openProjectDropdown = openProjectDropdown === {{ $orderer->id }} ? null : {{ $orderer->id }}; activeSection = 'orderer_{{ $orderer->id }}'"
                            class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-300 rounded hover:bg-gray-800 focus:outline-none"
                            :class="{ 'bg-gray-800': activeSection === 'orderer_{{ $orderer->id }}' }">
                            <span>{{ $orderer->orderer_name }}</span>
                            <svg :class="{ 'transform rotate-180': openProjectDropdown === {{ $orderer->id }} }" class="w-4 h-4 transition-transform">
                                <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openProjectDropdown === {{ $orderer->id }}" x-transition x-cloak class="ml-4 space-y-1">
                            <button @click="activeSection = 'createProject_{{ $orderer->id }}'" class="flex items-center p-2 text-sm font-medium text-gray-400 rounded hover:bg-gray-800 focus:outline-none"
                                    :class="{ 'bg-gray-800': activeSection === 'createProject_{{ $orderer->id }}' }">
                                ثبت پروژه جدید
                            </button>

                            @foreach ($orderer->projects as $project)
                                <button @click="openDrawingPartDropdown = openDrawingPartDropdown === {{ $project->id }} ? null : {{ $project->id }}; activeSection = 'project_{{ $project->id }}'"
                                    class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-400 rounded hover:bg-gray-800 focus:outline-none"
                                    :class="{ 'bg-gray-800': activeSection === 'project_{{ $project->id }}' }">
                                    <span>{{ $project->project_title }}</span>
                                    <svg :class="{ 'transform rotate-180': openDrawingPartDropdown === {{ $project->id }} }" class="w-4 h-4 transition-transform">
                                        <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="openDrawingPartDropdown === {{ $project->id }}" x-transition x-cloak class="ml-4 space-y-1">
                                    <button @click="activeSection = 'createDrawingPart_{{ $project->id }}'" class="flex items-center p-2 text-sm font-medium text-gray-500 rounded hover:bg-gray-800 focus:outline-none"
                                            :class="{ 'bg-gray-800': activeSection === 'createDrawingPart_{{ $project->id }}' }">
                                        افزودن نقشه و قطعه مربوطه
                                    </button>

                                    @foreach ($project->drawingParts as $drawingPart)
                                        <button @click="activeSection = 'drawingPart_{{ $drawingPart->id }}'" class="flex items-center p-2 text-sm font-medium text-gray-500 rounded hover:bg-gray-800 focus:outline-none"
                                                :class="{ 'bg-gray-800': activeSection === 'drawingPart_{{ $drawingPart->id }}' }">
                                            {{ $drawingPart->part_name }}
                                        </button>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-6 bg-gray-100">
        <!-- Overview Section -->
        <div x-show="activeSection === 'overview'" x-transition>
            <h1 class="mb-6 text-2xl font-bold">به سیستم مدیریت پروژه خوش آمدید</h1>
            <p class="text-lg">اینجا شما می‌توانید اطلاعات پروژه‌ها و کارفرمایان را مدیریت کنید.</p>
        </div>

        <!-- Sections for Creating Orderer, Project, and Drawing Part -->
        <div x-show="activeSection === 'createOrderer'" x-transition>
            <h1 class="mb-4 text-2xl font-bold">ثبت کارفرمای جدید</h1>
            <x-orderer-form />
        </div>

        @foreach ($orderers as $orderer)
            <div x-show="activeSection === 'orderer_{{ $orderer->id }}'" x-transition>
                <h1 class="text-2xl font-bold">{{ $orderer->orderer_name }}</h1>
                <!-- More details here -->
            </div>

            @foreach ($orderer->projects as $project)
                <div x-show="activeSection === 'project_{{ $project->id }}'" x-transition>
                    <h2 class="text-xl font-bold">{{ $project->project_title }}</h2>
                    <!-- Additional project details here -->
                </div>

                @foreach ($project->drawingParts as $drawingPart)
                    <div x-show="activeSection === 'drawingPart_{{ $drawingPart->id }}'" x-transition>
                        <h3 class="text-lg font-bold">{{ $drawingPart->part_name }}</h3>
                        <!-- Details of each drawing part here -->
                    </div>
                @endforeach
            @endforeach
        @endforeach
    </main>
</div>
@endsection
