@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('content')
<div class="flex h-screen" x-data="{ activeSection: 'overview', openOrdererDropdown: null, openProjectDropdown: null, openDrawingPartDropdown: null }">
    <!-- Sidebar Navigation -->
    <aside class="flex flex-col w-64 text-white bg-gray-900">
        <!-- Logo and Slogan -->
        <div class="flex flex-col items-center p-6">
            <img src="{{ asset('images/taamkarbrand.png') }}" alt="Tamkaar Logo" class="w-auto h-20 mb-2">
            <h2 class="text-2xl font-extrabold text-green-400 ">تامکار تبلور توان ایرانی</h2>
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

                    @forelse ($orderers as $orderer)
                        <button @click="openProjectDropdown = openProjectDropdown === {{ $orderer->id }} ? null : {{ $orderer->id }}; activeSection = 'orderer_{{ $orderer->id }}'"
                            class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-300 rounded hover:bg-gray-800 focus:outline-none"
                            :class="{ 'bg-gray-800': activeSection === 'orderer_{{ $orderer->id }}' }">
                            <span>{{ $orderer->orderer_name }}</span>
                            <svg :class="{ 'transform rotate-180': openProjectDropdown === {{ $orderer->id }} }" class="w-4 h-4 transition-transform">
                                <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Projects Dropdown Content -->
                        <div x-show="openProjectDropdown === {{ $orderer->id }}" x-transition x-cloak class="ml-4 space-y-1">
                            <button @click="activeSection = 'createProject_{{ $orderer->id }}'" class="flex items-center p-2 text-sm font-medium text-gray-400 rounded hover:bg-gray-800 focus:outline-none"
                                    :class="{ 'bg-gray-800': activeSection === 'createProject_{{ $orderer->id }}' }">
                                ثبت پروژه جدید
                            </button>

                            @forelse ($orderer->projects as $project)
                                <button @click="openDrawingPartDropdown = openDrawingPartDropdown === {{ $project->id }} ? null : {{ $project->id }}; activeSection = 'project_{{ $project->id }}'"
                                    class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-400 rounded hover:bg-gray-800 focus:outline-none"
                                    :class="{ 'bg-gray-800': activeSection === 'project_{{ $project->id }}' }">
                                    <span>{{ $project->project_title }}</span>
                                    <svg :class="{ 'transform rotate-180': openDrawingPartDropdown === {{ $project->id }} }" class="w-4 h-4 transition-transform">
                                        <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- DrawingParts Dropdown Content -->
                                <div x-show="openDrawingPartDropdown === {{ $project->id }}" x-transition x-cloak class="ml-4 space-y-1">
                                    <button @click="activeSection = 'createDrawingPart_{{ $project->id }}'" class="flex items-center p-2 text-sm font-medium text-gray-500 rounded hover:bg-gray-800 focus:outline-none"
                                            :class="{ 'bg-gray-800': activeSection === 'createDrawingPart_{{ $project->id }}' }">
                                        افزودن نقشه و قطعه مربوطه
                                    </button>

                                    @forelse ($project->drawingParts as $drawingPart)
                                        <button @click="activeSection = 'drawingPart_{{ $drawingPart->id }}'" class="flex items-center p-2 text-sm font-medium text-gray-500 rounded hover:bg-gray-800 focus:outline-none"
                                                :class="{ 'bg-gray-800': activeSection === 'drawingPart_{{ $drawingPart->id }}' }">
                                            {{ $drawingPart->part_name }}
                                        </button>
                                    @empty
                                        <p class="p-2 text-sm text-gray-500">بخشی برای این پروژه وجود ندارد</p>
                                    @endforelse
                                </div>
                            @empty
                                <p class="p-2 text-sm text-gray-500">پروژه‌ای برای این کارفرما وجود ندارد</p>
                            @endforelse
                        </div>
                    @empty
                        <p class="p-2 text-sm text-gray-500">کارفرمایی وجود ندارد</p>
                    @endforelse
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

        <!-- Create New project for the Orderer -->
        <div x-show="activeSection === 'createProject'" x-transition>
            <h1 class="mb-4 text-2xl font-bold">ثبت کارفرمای جدید</h1>
            <x-orderer-form />
        </div>

        <!-- Orderer Details Section -->
        @foreach ($orderers as $orderer)
          <div x-show="activeSection === 'createProject_{{ $orderer->id }}'" x-transition>
            <h1 class="mb-4 text-2xl font-bold">ثبت پروژه جدید</h1>
            <x-project-form :orderer="$orderer" />
          </div>

          <div x-show="activeSection === 'orderer_{{ $orderer->id }}'" x-transition>
              <h1 class="text-2xl font-bold">{{ $orderer->orderer_name }}</h1>
              <div class="flex gap-32 mt-10 mr-7">
                  <img src="{{ Storage::url($orderer->orderer_brand) }}" alt="{{ $orderer->orderer_name }}_brand" class="w-32 h-auto rounded-md shadow-sm">
                  <div class="border border-spacing-3">
                     <div>Email: {{ $orderer->orderer_email }}</div>
                     <div>Phone: {{ $orderer->orderer_phone }}</div>
                  </div>
                  <form action="{{ route('orderers.destroy', $orderer) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="p-2 m-2 text-white bg-red-600 rounded-md" type="submit">حذف کارفرما</button>
                  </form>
              </div>
          </div>

          @foreach ($orderer->projects as $project)
            <div x-show="activeSection === 'createDrawingPart_{{ $project->id }}'" x-transition>
                <h1 class="mb-4 text-2xl font-bold">افزودن نقشه و قطعه مربوطه  </h1>
                <x-drawing-part-form :project="$project" />
            </div>

            <div x-show="activeSection === 'project_{{ $project->id }}'" x-transition>
                <h1 class="text-2xl font-bold">{{ $project->project_title }}</h1>
                <p>شرح پروژه: {{ $project->project_description }}</p>
                <p>مدیر پروژه: {{ $project->project_manager }}</p>
                <p>تاریخ شروع: {{ $project->start_date }}</p>
            </div>

            <!-- DrawingPart Sections for each Project -->
            @foreach ($project->drawingParts as $drawingPart)
              <div x-show="activeSection === 'drawingPart_{{ $drawingPart->id }}'" x-transition>
                  <h1 class="text-2xl font-bold">{{ $drawingPart->part_name }}</h1>
                  <p>کد بخش: {{ $drawingPart->drawing_code }}</p>
                  <p>نام دستگاه: {{ $drawingPart->device }}</p>
                  <p>نوع قطعه: {{ $drawingPart->part_type }}</p>
                  <p>توضیحات: {{ $drawingPart->part_description }}</p>
                  <img src="{{ Storage::url('drawings/' . $drawingPart->drawing_file) }}" alt="Drawing Image" class="w-32 h-auto rounded shadow-sm">

                  <!-- Dimension Form and Table -->
                  <div class="p-4 mt-4 bg-yellow-400 rounded">
                      <h2 class="mb-2 text-xl font-bold">Add Dimension</h2>
                      <x-dimension-form :drawingPart="$drawingPart" :project="$project" />

                      <h2 class="mt-6 mb-2 text-xl font-bold">Dimensions List</h2>
                      <table class="w-full text-sm text-left text-gray-700">
                          <thead>
                              <tr>
                                  <th>Nominal Size</th>
                                  <th>Upper Tolerance</th>
                                  <th>Lower Tolerance</th>
                                  <th>View or Section</th>
                                  <th>Tag</th>
                              </tr>
                          </thead>
                          <tbody>
                              @forelse ($drawingPart->dimensions as $dimension)
                                  <tr>
                                      <td>{{ $dimension->nominal_size }}</td>
                                      <td>{{ $dimension->UpperTolerance }}</td>
                                      <td>{{ $dimension->LowerTolerance }}</td>
                                      <td>{{ $dimension->viewOrSection }}</td>
                                      <td>{{ $dimension->tag }}</td>
                                  </tr>
                              @empty
                                  <tr>
                                      <td colspan="5" class="text-center">بعدی اضافه نشده</td>
                                  </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
              </div>
            @endforeach
          @endforeach
        @endforeach
    </main>
</div>
@endsection
