<x-app-layout>
    <div class="flex h-screen" x-data="{ activeSection: 'overview', openOrdererDropdown: false }">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <!-- Custom Logo and Slogan -->
            <div class="p-6 flex flex-col items-center">
                <img src="{{ asset('images/taamkarbrand.png') }}" alt="Tamkaar Logo" class="h-20 w-auto mb-2">
                <h2 class="text-lg font-extrabold text-green-300">تامکار تبلور توان ایرانی</h2>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 space-y-2 mt-6">
                <!-- Project Management System -->
                <div>
                    <!-- Main Dropdown Toggle for "سیستم مدیریت پروژه ها" -->
                    <button @click="openOrdererDropdown = !openOrdererDropdown" class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-300 hover:bg-gray-700 rounded focus:outline-none">
                        <span>سیستم مدیریت پروژه ها</span>
                        <svg :class="{ 'transform rotate-180': openOrdererDropdown }" class="w-4 h-4 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Content for Project Management System -->
                    <div x-show="openOrdererDropdown" x-transition class="mt-2 ml-4 space-y-1">
                        <!-- Create New Orderer Option -->
                        <button @click="activeSection = 'createOrderer'" class="flex items-center w-full p-2 text-sm font-medium text-gray-400 hover:text-gray-200 hover:bg-gray-700 rounded focus:outline-none"
                                :class="{ 'bg-gray-700': activeSection === 'createOrderer' }">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            ثبت کارفرمای جدید
                        </button>

                        <!-- List of Existing Orderers -->
                        @forelse ($orderers as $orderer)
                            <div x-data="{ openOrdererOptions: false }">
                                <!-- Orderer Name with Dropdown Toggle -->
                                <button @click="activeSection = 'orderer_{{ $orderer->id }}'" class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-400 hover:text-gray-200 hover:bg-gray-700 rounded focus:outline-none"
                                        :class="{ 'bg-gray-700': activeSection === 'orderer_{{ $orderer->id }}' }">
                                    <span>{{ $orderer->orderer_name }}</span>
                                </button>
                            </div>
                        @empty
                            <p class="p-2 text-sm text-gray-500">هیچ کافرمایی وجود ندارد</p>
                        @endforelse
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 bg-gray-100">
              <!-- Display Create New Orderer Form when selected -->
    <div x-show="activeSection === 'createOrderer'" x-transition>
        <h1 class="text-2xl font-semibold mb-4">ثبت کارفرمای جدید</h1>
        <x-orderer-form /> <!-- Using the form component here -->
    </div>
            </div>

            <!-- Sections for Each Existing Orderer -->
            @foreach ($orderers as $orderer)
                <div x-show="activeSection === 'orderer_{{ $orderer->id }}'" x-transition>
                    <h1 class="text-2xl font-semibold">{{ $orderer->orderer_name }}</h1>
                    <p>Details and future features for {{ $orderer->orderer_name }} will be displayed here.</p>
                </div>
            @endforeach
        </main>
    </div>
</x-app-layout>
