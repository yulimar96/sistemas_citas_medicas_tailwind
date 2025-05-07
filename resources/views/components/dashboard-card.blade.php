@props([
    'title',
    'count',
    'icon',
    'color' => 'blue',
    'route',
    'permission' => null
])

@php
    $colors = [
        'blue' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'dark' => 'dark:bg-blue-900 dark:text-blue-200'],
        'purple' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'dark' => 'dark:bg-purple-900 dark:text-purple-200'],
        'green' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'dark' => 'dark:bg-green-900 dark:text-green-200'],
        'red' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'dark' => 'dark:bg-red-900 dark:text-red-200'],
        'indigo' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-800', 'dark' => 'dark:bg-indigo-900 dark:text-indigo-200'],
        'yellow' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'dark' => 'dark:bg-yellow-900 dark:text-yellow-200']
    ];

    $selectedColor = $colors[$color] ?? $colors['blue'];
@endphp

<div class="dashboard-card group" data-permission="{{ $permission }}">
    <div class="icon-container {{ $selectedColor['bg'] }} {{ $selectedColor['dark'] }}">
        {{-- <x-dynamic-component :component="'icons.'.$icon" class="w-6 h-6" /> --}}
    </div>
    <h3 class="card-title">{{ $title }}</h3>
    <p class="card-count">{{ $count }}</p>
    <a href="{{ route($route) }}" class="card-link" aria-label="Ver más información sobre {{ $title }}">
        Ver detalles
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>
</div>