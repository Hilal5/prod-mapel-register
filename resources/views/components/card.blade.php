@props([
    'title' => null,
    'subtitle' => null,
    'padding' => 'p-6',
    'shadow' => 'shadow-lg',
    'hover' => false
])

<div {{ $attributes->merge(['class' => "bg-white rounded-lg $shadow $padding " . ($hover ? 'hover:shadow-xl transition-shadow duration-300' : '')]) }}>
    @if($title || $subtitle)
        <div class="mb-4">
            @if($title)
                <h3 class="text-xl font-bold text-gray-800">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="text-sm text-gray-600 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div>
        {{ $slot }}
    </div>
</div>