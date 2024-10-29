<aside class="flex flex-col w-64 p-4 text-white bg-gray-900" x-data="{ openOrdererDropdown: null, openProjectDropdown: null, openDrawingPartDropdown: null }">
    <div class="flex flex-col items-center">
        <img src="{{ asset('images/taamkarbrand.png') }}" alt="Tamkaar Logo" class="w-auto h-20 mb-2">
        <h2 class="text-2xl font-extrabold text-green-400">تامکار تبلور توان ایرانی</h2>
    </div>

    <nav class="flex-1 mt-6 space-y-2">
        <button @click="activeSection = 'overview'" class="flex items-center p-2 text-sm font-medium rounded hover:bg-gray-800"
                :class="{ 'bg-gray-800': activeSection === 'overview' }">
            سیستم مدیریت پروژه‌ها
        </button>

        <div class="mt-4">
            <button @click="openOrdererDropdown = !openOrdererDropdown" class="flex justify-between w-full p-2 text-sm font-medium rounded hover:bg-gray-800">
                <span>کارفرمایان</span>
                <svg :class="{ 'transform rotate-180': openOrdererDropdown }" class="w-4 h-4 transition-transform">
                    <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="openOrdererDropdown" x-transition x-cloak class="ml-4 space-y-1">
                @foreach ($orderers as $orderer)
                    <button @click="openProjectDropdown = openProjectDropdown === {{ $orderer->id }} ? null : {{ $orderer->id }}; activeSection = 'orderer_{{ $orderer->id }}'"
                            class="flex justify-between w-full p-2 text-sm font-medium rounded hover:bg-gray-800"
                            :class="{ 'bg-gray-800': activeSection === 'orderer_{{ $orderer->id }}' }">
                        {{ $orderer->orderer_name }}
                        <svg :class="{ 'transform rotate-180': openProjectDropdown === {{ $orderer->id }} }" class="w-4 h-4 transition-transform">
                            <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Nested Project Dropdowns -->
                    <div x-show="openProjectDropdown === {{ $orderer->id }}" x-transition x-cloak class="ml-4 space-y-1">
                        @foreach ($orderer->projects as $project)
                            <button @click="openDrawingPartDropdown = openDrawingPartDropdown === {{ $project->id }} ? null : {{ $project->id }}; activeSection = 'project_{{ $project->id }}'"
                                    class="flex justify-between w-full p-2 text-sm font-medium rounded hover:bg-gray-800"
                                    :class="{ 'bg-gray-800': activeSection === 'project_{{ $project->id }}' }">
                                {{ $project->project_title }}
                                <svg :class="{ 'transform rotate-180': openDrawingPartDropdown === {{ $project->id }} }" class="w-4 h-4 transition-transform">
                                    <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Drawing Parts Nested Dropdowns -->
                            <div x-show="openDrawingPartDropdown === {{ $project->id }}" x-transition x-cloak class="ml-4 space-y-1">
                                @foreach ($project->drawingParts as $drawingPart)
                                    <button @click="activeSection = 'drawingPart_{{ $drawingPart->id }}'"
                                            class="flex items-center p-2 text-sm font-medium rounded hover:bg-gray-800"
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
