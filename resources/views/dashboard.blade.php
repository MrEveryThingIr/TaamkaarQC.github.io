<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('content')
<div class="flex h-screen" x-data="{ activeSection: 'overview', openOrdererDropdown: null, openProjectDropdown: null }">
    <!-- Sidebar Navigation -->
    <aside class="flex flex-col w-64 text-white bg-gray-800">
        <!-- Logo and Slogan -->
        <div class="flex flex-col items-center p-6">
            <img src="{{ asset('images/taamkarbrand.png') }}" alt="Tamkaar Logo" class="w-auto h-20 mb-2">
            <h2 class="text-lg font-extrabold text-green-300">تامکار تبلور توان ایرانی</h2>
        </div>

        <!-- Main Navigation Links -->
        <nav class="flex-1 px-4 mt-6 space-y-2">
            <!-- Main Dashboard Overview Link -->
            <button @click="activeSection = 'overview'" class="flex items-center p-2 text-sm font-medium text-gray-300 rounded hover:bg-gray-700 focus:outline-none"
                    :class="{ 'bg-gray-700': activeSection === 'overview' }">
                سیستم مدیریت پروژه ها
            </button>

            <!-- Orderers Section with Projects under Each Orderer -->
            <div class="mt-4">
                <!-- Orderers Heading and Toggle -->
                <button @click="openOrdererDropdown = !openOrdererDropdown" class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-300 rounded hover:bg-gray-700 focus:outline-none">
                    <span>کارفرمایان</span>
                    <svg :class="{ 'transform rotate-180': openOrdererDropdown }" class="w-4 h-4 transition-transform">
                        <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Content for Orderers -->
                <div x-show="openOrdererDropdown" x-transition x-cloak class="ml-4 space-y-1">
                    <!-- New Orderer Option -->
                    <button @click="activeSection = 'createOrderer'" class="flex items-center p-2 text-sm font-medium text-gray-400 rounded hover:bg-gray-700 focus:outline-none"
                            :class="{ 'bg-gray-700': activeSection === 'createOrderer' }">
                        ثبت کارفرمای جدید
                    </button>

                    <!-- Loop Through Orderers -->
                    @foreach ($orderers as $orderer)
                        <!-- Orderer Toggle Button -->
                        <button @click="openProjectDropdown = openProjectDropdown === {{ $orderer->id }} ? null : {{ $orderer->id }}; activeSection = 'orderer_{{ $orderer->id }}'"
                                class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-300 rounded hover:bg-gray-700 focus:outline-none"
                                :class="{ 'bg-gray-700': activeSection === 'orderer_{{ $orderer->id }}' }">
                            <span>{{ $orderer->orderer_name }}</span>
                            <svg :class="{ 'transform rotate-180': openProjectDropdown === {{ $orderer->id }} }" class="w-4 h-4 transition-transform">
                                <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Projects under Orderer Dropdown -->
                        <div x-show="openProjectDropdown === {{ $orderer->id }}" x-transition x-cloak class="ml-4 space-y-1">
                            <!-- New Project Option -->
                            <button @click="activeSection = 'createProject_{{ $orderer->id }}'" class="flex items-center p-2 text-sm font-medium text-gray-400 rounded hover:bg-gray-700 focus:outline-none"
                                    :class="{ 'bg-gray-700': activeSection === 'createProject_{{ $orderer->id }}' }">
                                ثبت پروژه جدید
                            </button>

                            <!-- List of Existing Projects for Each Orderer -->
                            @forelse ($orderer->projects as $project)
                                <button @click="activeSection = 'project_{{ $project->id }}'" class="flex items-center p-2 text-sm font-medium text-gray-400 rounded hover:bg-gray-700 focus:outline-none"
                                        :class="{ 'bg-gray-700': activeSection === 'project_{{ $project->id }}' }">
                                    {{ $project->project_title }}
                                </button>
                            @empty
                                <p class="p-2 text-sm text-gray-500">پروژه ای وجود ندارد</p>
                            @endforelse
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
            <p class="text-lg">اینجا شما می توانید اطلاعات پروژه‌ها و کارفرمایان را مدیریت کنید.</p>
        </div>

        <!-- Create New Orderer Section -->
        <div x-show="activeSection === 'createOrderer'" x-transition>
            <h1 class="mb-4 text-2xl font-bold">ثبت کارفرمای جدید</h1>
            <x-orderer-form />
        </div>

        <!-- Orderer Details and Related Projects Section -->
        @foreach ($orderers as $orderer)
            <!-- Orderer Information -->
            <div x-show="activeSection === 'orderer_{{ $orderer->id }}'" x-transition>
                <h1 class="text-2xl font-bold">{{ $orderer->orderer_name }}</h1>
                <p>اطلاعات کارفرما و پروژه‌های مربوطه</p>
            </div>

            <!-- Project Creation Form for Each Orderer -->
            <div x-show="activeSection === 'createProject_{{ $orderer->id }}'" x-transition>
                <h1 class="mb-4 text-2xl font-bold">ثبت پروژه جدید برای {{ $orderer->orderer_name }}</h1>
                <x-project-form :orderer="$orderer">
                    <p>توضیحات تکمیلی برای فرم ثبت پروژه جدید را اینجا وارد کنید.</p>
                </x-project-form>
            </div>

            <!-- Project Detail Sections for Each Project of Orderer -->
            @foreach ($orderer->projects as $project)
                <div x-show="activeSection === 'project_{{ $project->id }}'" x-transition>
                    <h1 class="text-2xl font-bold">{{ $project->project_title }}</h1>
                    <p>شرح پروژه: {{ $project->project_description }}</p>
                    <p>مدیر پروژه: {{ $project->project_manager }}</p>
                    <p>تاریخ شروع: {{ $project->start_date }}</p>
                </div>
            @endforeach
        @endforeach
    </main>
</div>
@endsection
