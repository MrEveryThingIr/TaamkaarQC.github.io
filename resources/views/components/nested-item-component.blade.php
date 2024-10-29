<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
</div>

<!-- resources/views/components/nested-item-component.blade.php -->
<div>
    <button @click="toggleSection('{{ $item->{$idField} }}')"
            class="flex items-center justify-between w-full p-2 text-sm font-medium text-gray-300 rounded hover:bg-gray-700 focus:outline-none"
            :class="{ 'bg-gray-700': activeSection === '{{ $item->{$idField} }}' }">
        <span>{{ $item->{$labelField} }}</span>
        @if ($subItems && $subItems->isNotEmpty())
            <svg :class="{ 'transform rotate-180': openSection === '{{ $item->{$idField} }}' }" class="w-4 h-4 transition-transform">
                <path stroke="currentColor" stroke-width="2" fill="none" d="M19 9l-7 7-7-7" />
            </svg>
        @endif
    </button>

    <!-- Recursively Render Nested SubItems -->
    @if ($subItems && $subItems->isNotEmpty())
        <div x-show="openSection === '{{ $item->{$idField} }}'" x-transition x-cloak class="ml-4 space-y-1">
            @foreach ($subItems as $subItem)
                <x-nested-item-component :item="$subItem"
                                         :sub-items="$subItem->{$childField}"
                                         :label-field="'project_title'"
                                         :id-field="'id'"
                                         :child-field="'tasks'"/>
            @endforeach
        </div>
    @endif
</div>
