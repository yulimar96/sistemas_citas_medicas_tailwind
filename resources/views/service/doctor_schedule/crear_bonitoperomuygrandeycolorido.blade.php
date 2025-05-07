@extends('layouts.app')

@push('css')
    <!-- CDN optimizados con preconnect -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <!-- Estilos personalizados con paleta de colores vibrantes y felices -->
    <style>
        :root {
            --primary: #6366f1;  /* Violeta vibrante */
            --primary-hover: #4f46e5;
            --secondary: #f59e0b; /* Amarillo/anaranjado */
            --success: #10b981;   /* Verde esmeralda */
            --warning: #f97316;   /* Naranja */
            --danger: #ef4444;    /* Rojo */
            --info: #0ea5e9;      /* Azul cielo */
            --happy: #f472b6;     /* Rosa alegre */
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --bg-light: #f9fafb;
            --bg-card: #ffffff;
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --gradient-happy: linear-gradient(135deg, #f472b6 0%, #f59e0b 100%);
        }
        
        .dark {
            --primary: #818cf8;
            --primary-hover: #6366f1;
            --happy: #ec4899;
            --text-primary: #f3f4f6;
            --text-secondary: #d1d5db;
            --bg-light: #111827;
            --bg-card: #1f2937;
            --gradient-primary: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
            --gradient-happy: linear-gradient(135deg, #ec4899 0%, #f59e0b 100%);
        }
        
        /* Animaciones y transiciones mejoradas */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        
        .  {
            animation: fadeIn 0.3s ease-out forwards;
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .transition-all {
            transition: all 0.3s ease;
        }
        
        /* Efectos hover mejorados */
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }
        
        /* Badges coloridos con más personalidad */
        .badge {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
        }
        
        .badge-primary {
            @apply bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200;
        }
        
        .badge-secondary {
            @apply bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200;
        }
        
        .badge-success {
            @apply bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200;
        }
        
        .badge-danger {
            @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200;
        }
        
        .badge-happy {
            @apply bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200;
        }
        
        /* Botones con gradiente y efectos */
        .btn-gradient {
            background-image: var(--gradient-primary);
            @apply text-white font-medium rounded-lg transition-all hover:opacity-90 btn-hover;
        }
        
        .btn-happy {
            background-image: var(--gradient-happy);
            @apply text-white font-medium rounded-lg transition-all hover:opacity-90 btn-hover;
        }
        
        /* Efecto de confeti para acciones importantes */
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--happy);
            opacity: 0;
        }
        
        /* Mejoras en el calendario */
        .calendar-cell {
            @apply p-2 border border-gray-200 dark:border-gray-700 text-center;
            min-height: 80px;
            position: relative;
        }
        
        .calendar-cell:hover {
            @apply bg-gray-50 dark:bg-gray-700;
            transform: scale(1.03);
            z-index: 10;
        }
        
        .calendar-time {
            @apply font-bold text-sm text-gray-500 dark:text-gray-400;
        }
        
        /* Efecto de carga optimizado */
        .skeleton {
            @apply bg-gray-200 dark:bg-gray-700 rounded animate-pulse;
        }
        
        /* Scroll personalizado */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            @apply bg-gray-100 dark:bg-gray-800;
        }
        
        ::-webkit-scrollbar-thumb {
            @apply bg-gray-300 dark:bg-gray-600 rounded-full;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            @apply bg-gray-400 dark:bg-gray-500;
        }
    </style>
@endpush

@section('title', 'Gestión de Horarios Médicos')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado con animación y confeti -->
      <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Cronograma</span>
                    </div>
                </li>
            </ol>
        </nav>
    

    <!-- Notificaciones con animaciones mejoradas -->
    <div class="fixed top-4 right-4 space-y-3 z-50" id="notifications">
        @if (session('success'))
            <div class="  bg-emerald-500 text-white p-4 rounded-lg shadow-lg flex items-center max-w-md transform transition-all hover:scale-105">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <div class="flex-1">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
                <button class="ml-4 opacity-70 hover:opacity-100" aria-label="Cerrar notificación">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="  bg-red-500 text-white p-4 rounded-lg shadow-lg flex items-center max-w-md transform transition-all hover:scale-105">
                <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                <div class="flex-1">
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
                <button class="ml-4 opacity-70 hover:opacity-100" aria-label="Cerrar notificación">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- Sección principal con skeleton loading -->
    <main class="space-y-8" id="mainContent">
        
        <!-- Tarjeta de horarios activos -->
        <section class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all card-hover">
            <!-- Header de la tarjeta -->
            <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <div class="mb-8 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-xl p-6 text-white relative overflow-hidden  ">
        <!-- Confeti decorativo -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative">
            <div>
                <h1 class="text-3xl font-bold ">
                    <i class="fas fa-calendar-alt mr-2"></i> Gestión de Horarios Médicos
                </h1>
                <p class="mt-2 opacity-90">
                    Administra y visualiza los horarios de atención de los médicos
                </p>
            </div>
            <button 
                id="createScheduleBtn"
                class="btn-happy flex items-center px-6 py-3 shadow-lg hover:shadow-xl "
                aria-label="Crear nuevo horario"
            >
                <i class="fas fa-plus mr-2"></i>
                Crear Horario
            </button>
        </div>
    </div>
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-list-alt mr-2 text-indigo-500"></i> Horarios Activos
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">
                            Lista completa de horarios médicos registrados
                        </p>
                    </div>
                    
                    <!-- Barra de búsqueda y filtros mejorada -->
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <div class="relative flex-1 md:w-64">
                            <label for="searchSchedule" class="sr-only">Buscar horario</label>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                id="searchSchedule" 
                                placeholder="Buscar médico, especialidad..." 
                                class="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 transition-all"
                            >
                        </div>
                        
                        <button 
                            id="filterBtn"
                            class="p-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-all btn-hover"
                            aria-label="Filtrar horarios"
                        >
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Tabla responsiva con paginación mejorada -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 data-table">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Médico
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Especialidad
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Consultorio
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Turno
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Día
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Horario
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($schedules as $schedule)
                        <tr class="  hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" data-id="{{ $schedule->id }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $schedule->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center transition-all hover:bg-indigo-200 dark:hover:bg-indigo-800">
                                        <span class="text-indigo-600 dark:text-indigo-300 font-medium">
                                            {{ substr($schedule->doctor->person->name_1, 0, 1) }}{{ substr($schedule->doctor->person->surname_1, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $schedule->doctor->person->name_1 }} {{ $schedule->doctor->person->surname_1 }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $schedule->doctor->person->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="badge badge-primary">
                                    {{ $schedule->doctor->specialitys ? $schedule->doctor->specialitys->name : 'Sin especialidad' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <div>
                                    {{ $schedule->organizationalUnit ? $schedule->organizationalUnit->name : 'Sin organización' }}
                                    @if($schedule->organizationalUnit && $schedule->organizationalUnit->location)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $schedule->organizationalUnit->location }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $shiftClasses = [
                                        'morning' => 'badge-secondary',
                                        'evening' => 'badge-primary',
                                        'afternoon' => 'badge-warning',
                                        'night' => 'badge-danger'
                                    ];
                                    $shiftText = [
                                        'morning' => 'Mañana',
                                        'evening' => 'Diurno',
                                        'afternoon' => 'Tarde',
                                        'night' => 'Noche'
                                    ];
                                @endphp
                                <span class="badge {{ $shiftClasses[$schedule->shift] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $shiftText[$schedule->shift] ?? $schedule->shift }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ ucfirst($schedule->day) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="font-medium">{{ substr($schedule->start_time, 0, 5) }}</span>
                                    <span class="text-gray-400">-</span>
                                    <span class="font-medium">{{ substr($schedule->closing_time, 0, 5) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button 
                                        class="text-amber-500 hover:text-amber-700 dark:hover:text-amber-400 p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors btn-hover"
                                        aria-label="Editar horario"
                                        onclick="editarHorario({{ $schedule->id }})"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <button 
                                        type="button"
                                        class="text-red-500 hover:text-red-700 dark:hover:text-red-400 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors btn-hover"
                                        aria-label="Eliminar horario"
                                        onclick="confirmDelete({{ $schedule->id }})"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación mejorada con animaciones -->
            @if($schedules->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    Mostrando <span class="font-medium">{{ $schedules->firstItem() }}</span> a <span class="font-medium">{{ $schedules->lastItem() }}</span> de <span class="font-medium">{{ $schedules->total() }}</span> resultados
                </div>
                <div class="flex space-x-2">
                    @if($schedules->onFirstPage())
                        <span class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-left"></i>
                        </span>
                    @else
                        <a href="{{ $schedules->previousPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors btn-hover">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    @endif
                    
                    @foreach(range(1, min(5, $schedules->lastPage())) as $page)
                        <a href="{{ $schedules->url($page) }}" class="px-3 py-1 rounded-md border {{ $schedules->currentPage() == $page ? 'bg-indigo-500 text-white border-indigo-500' : 'border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }} transition-colors btn-hover">
                            {{ $page }}
                        </a>
                    @endforeach
                    
                    @if($schedules->hasMorePages())
                        <a href="{{ $schedules->nextPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors btn-hover">
                            <i class="fas fa-angle-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    @endif
                </div>
            </div>
            @endif
        </section>
        
        <!-- Calendario visual mejorado con aspecto real -->
        <section class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all card-hover  ">
            <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-calendar-week mr-2 text-indigo-500"></i> Vista Semanal
                </h2>
            </div>
            
            <div class="overflow-x-auto p-4">
                <div class="min-w-full grid grid-cols-8 gap-1">
                    <!-- Header de días -->
                    <div class="col-span-1"></div>
                    @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $day)
                    <div class="text-center font-medium py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-200 rounded-lg">
                        {{ $day }}
                    </div>
                    @endforeach
                    
                    <!-- Filas de horas -->
                    @php
                        $times = [
                            '08:00:00 - 09:00:00',
                            '09:00:00 - 10:00:00',
                            '10:00:00 - 11:00:00',
                            '11:00:00 - 12:00:00',
                            '12:00:00 - 13:00:00',
                            '13:00:00 - 14:00:00',
                            '14:00:00 - 15:00:00',
                            '15:00:00 - 16:00:00',
                            '16:00:00 - 17:00:00',
                            '17:00:00 - 18:00:00',
                            '18:00:00 - 19:00:00',
                        ];
                    @endphp
                    
                    @foreach ($times as $time)
                    @php
                        [$start_time, $closing_time] = explode(' - ', $time);
                    @endphp
                    <div class="col-span-1 calendar-time py-2">
                        {{ substr($start_time, 0, 5) }}
                    </div>
                    
                    @foreach(['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'] as $day)
                    @php
                        $doctor = null;
                        $scheduleData = null;
                        foreach ($schedules as $schedule) {
                            if (
                                strtolower($schedule->day) == $day &&
                                $start_time < $schedule->closing_time &&
                                $closing_time > $schedule->start_time
                            ) {
                                $doctor = $schedule->doctor;
                                $scheduleData = $schedule;
                                break;
                            }
                        }
                    @endphp
                    <div class="calendar-cell group {{ $doctor ? 'bg-emerald-50 dark:bg-emerald-900/20' : 'bg-gray-50 dark:bg-gray-700/50' }}">
                        @if($doctor)
                            <div class="flex flex-col h-full justify-between">
                                <div class="font-medium text-emerald-700 dark:text-emerald-300 text-sm truncate">
                                    {{ $doctor->person->name_1 }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ substr($scheduleData->start_time, 0, 5) }} - {{ substr($scheduleData->closing_time, 0, 5) }}
                                </div>
                                <div class="absolute z-10 left-1/2 transform -translate-x-1/2 mt-2 hidden group-hover:block w-64 bg-gray-800 text-white text-sm rounded-lg p-3 shadow-lg">
                                    <p class="font-medium">{{ $doctor->person->name_1 }} {{ $doctor->person->surname_1 }}</p>
                                    <p class="text-xs mt-1 opacity-80">{{ $doctor->specialitys ? $doctor->specialitys->name : 'Sin especialidad' }}</p>
                                    <div class="mt-2 pt-2 border-t border-gray-700 text-xs">
                                        <p><i class="fas fa-clock mr-1"></i> {{ substr($scheduleData->start_time, 0, 5) }} - {{ substr($scheduleData->closing_time, 0, 5) }}</p>
                                        <p class="mt-1"><i class="fas fa-door-open mr-1"></i> {{ $scheduleData->organizationalUnit ? $scheduleData->organizationalUnit->name : 'Sin consultorio' }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-gray-400 text-sm">&mdash;</span>
                        @endif
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Modal para crear/editar horario con animaciones -->
<div id="scheduleModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full  ">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-xl dark:bg-gray-700 overflow-hidden">
            <!-- Modal header con gradiente -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-gradient-to-r from-indigo-500 to-purple-600">
                <h3 class="text-xl font-semibold text-white" id="modalTitle">
                    Nuevo Horario Médico
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-indigo-600 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-all hover:rotate-90" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-6">
                <form id="scheduleForm" method="POST" action="">
                    @method('PATCH')
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Campo Médico con búsqueda mejorada -->
                        <div class="col-span-2">
                            <label for="doctor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Médico <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select 
                                    id="doctor_id" 
                                    name="doctor_id" 
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all"
                                >
                                    <option value="" disabled selected>Seleccione un médico</option>
                                    @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" data-speciality="{{ $doctor->specialitys ? $doctor->specialitys->name : '' }}">
                                        {{ $doctor->person->name_1 }} {{ $doctor->person->surname_1 }} | {{ $doctor->specialitys ? $doctor->specialitys->name : 'Sin especialidad' }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-user-md text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Campo Consultorio con búsqueda mejorada -->
                        <div class="col-span-2">
                            <label for="organization_unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Consultorio <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select 
                                    id="organization_unit_id" 
                                    name="organization_unit_id" 
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all"
                                >
                                    <option value="" disabled selected>Seleccione un consultorio</option>
                                    @foreach ($organizational_unit as $unit)
                                    <option value="{{ $unit->id }}" data-location="{{ $unit->location }}">
                                        {{ $unit->name }} ({{ $unit->location }})
                                    </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-door-open text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Día de la semana con iconos -->
                        <div>
                            <label for="day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Día <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select 
                                    id="day" 
                                    name="day" 
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all"
                                >
                                    <option value="" disabled selected>Seleccione un día</option>
                                    <option value="lunes"><i class="fas fa-calendar-day mr-2"></i> Lunes</option>
                                    <option value="martes"><i class="fas fa-calendar-day mr-2"></i> Martes</option>
                                    <option value="miércoles"><i class="fas fa-calendar-day mr-2"></i> Miércoles</option>
                                    <option value="jueves"><i class="fas fa-calendar-day mr-2"></i> Jueves</option>
                                    <option value="viernes"><i class="fas fa-calendar-day mr-2"></i> Viernes</option>
                                    <option value="sábado"><i class="fas fa-calendar-day mr-2"></i> Sábado</option>
                                    <option value="domingo"><i class="fas fa-calendar-day mr-2"></i> Domingo</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-calendar-day text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Turno con iconos -->
                        <div>
                            <label for="shift" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Turno <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select 
                                    id="shift" 
                                    name="shift" 
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all"
                                >
                                    <option value="" disabled selected>Seleccione un turno</option>
                                    <option value="morning"><i class="fas fa-sun mr-2"></i> Mañana</option>
                                    <option value="evening"><i class="fas fa-clock mr-2"></i> Diurno</option>
                                    <option value="afternoon"><i class="fas fa-cloud-sun mr-2"></i> Tarde</option>
                                    <option value="night"><i class="fas fa-moon mr-2"></i> Noche</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-clock text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hora de inicio con icono -->
                        <div>
                            <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Hora de inicio <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="time" 
                                    id="start_time" 
                                    name="start_time" 
                                    required
                                    step="300"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all"
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-clock text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hora de fin con icono -->
                        <div>
                            <label for="closing_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Hora de fin <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="time" 
                                    id="closing_time" 
                                    name="closing_time" 
                                    required
                                    step="300"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all"
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-clock text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end gap-3">
                        <button 
                            type="button"
                            onclick="closeModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 transition-all btn-hover"
                        >
                            Cancelar
                        </button>
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all btn-hover"
                        >
                            Guardar Horario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Formulario oculto para eliminación -->
@foreach ($schedules as $schedule)
<form method="POST" action="{{ route('doctor_schedule.destroy', ['id' => $schedule->id]) }}" id="form-eliminar-{{ $schedule->id }}" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endforeach

@endsection

@push('js')
<!-- CDN optimizados con preload -->
<link rel="preload" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest" as="script">
<link rel="preload" href="https://cdn.jsdelivr.net/npm/flatpickr" as="script">
<link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@11" as="script">

<!-- Scripts con carga diferida para mejor rendimiento -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<!-- Scripts personalizados optimizados -->
<script>
// Mostrar skeleton loading mientras se carga el contenido
document.addEventListener('DOMContentLoaded', function() {
    // Inicialización de DataTables con mejoras de rendimiento
    setTimeout(() => {
        const dataTable = new simpleDatatables.DataTable('.data-table', {
            searchable: true,
            fixedHeight: false,
            perPage: 10,
            perPageSelect: [5, 10, 20, 50],
            labels: {
                placeholder: "Buscar...",
                perPage: "{select} registros por página",
                noRows: "No se encontraron registros",
                info: "Mostrando {start} a {end} de {rows} registros",
            },
            classes: {
                active: "bg-indigo-50 text-indigo-600",
                disabled: "opacity-50 cursor-not-allowed",
                paginationButton: "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white",
                paginationButtonCurrent: "flex items-center justify-center px-3 h-8 text-indigo-600 border border-indigo-300 bg-indigo-50 hover:bg-indigo-100 hover:text-indigo-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
            }
        });
        
        // Búsqueda dinámica con debounce para mejor rendimiento
        let searchTimeout;
        document.getElementById('searchSchedule').addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                dataTable.search(e.target.value);
            }, 300);
        });
    }, 100);
    
    // Cerrar notificaciones automáticamente
    setTimeout(() => {
        const notifications = document.querySelectorAll('#notifications > div');
        notifications.forEach(notification => {
            notification.classList.add('opacity-0', 'transition-all', 'duration-300');
            setTimeout(() => notification.remove(), 300);
        });
    }, 5000);
    
    // Cerrar notificaciones al hacer click
    document.querySelectorAll('#notifications button').forEach(button => {
        button.addEventListener('click', (e) => {
            e.target.closest('div').classList.add('opacity-0', 'transition-all', 'duration-300');
            setTimeout(() => e.target.closest('div').remove(), 300);
        });
    });
    
    // Manejo del modal
    const modal = document.getElementById('scheduleModal');
    const modalTitle = document.getElementById('modalTitle');
    const scheduleForm = document.getElementById('scheduleForm');
    
    // Botón para crear nuevo horario con efecto de confeti
    document.getElementById('createScheduleBtn').addEventListener('click', () => {
        modalTitle.textContent = 'Nuevo Horario Médico';
        scheduleForm.action = "{{ route('doctor_schedule.store') }}";
        scheduleForm.querySelector('input[name="_method"]').value = 'POST';
        resetForm();
        modal.classList.remove('hidden');
        
        // Efecto de confeti
        createConfetti();
    });
    
    // Función para crear efecto de confeti
    function createConfetti() {
        const colors = ['#6366f1', '#8b5cf6', '#f472b6', '#f59e0b', '#10b981'];
        const container = document.querySelector('header');
        
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.top = Math.random() * 100 + '%';
            confetti.style.width = Math.random() * 10 + 5 + 'px';
            confetti.style.height = Math.random() * 10 + 5 + 'px';
            confetti.style.animation = `float ${Math.random() * 3 + 2}s infinite ${Math.random() * 0.5}s`;
            container.appendChild(confetti);
            
            // Eliminar después de la animación
            setTimeout(() => {
                confetti.remove();
            }, 5000);
        }
    }
});

// Función para editar horario con feedback visual
async function editarHorario(scheduleId) {
    try {
        // Mostrar loader
        const row = document.querySelector(`tr[data-id="${scheduleId}"]`);
        row.classList.add('opacity-50');
        
        const response = await fetch(`/schedules/${scheduleId}`);
        if (!response.ok) throw new Error('Error al cargar los datos');
        
        const data = await response.json();
        
        // Formatear horas para input type="time"
        const formatTime = (timeString) => {
            if (!timeString) return '';
            const date = new Date(`2000-01-01T${timeString}`);
            return isNaN(date) ? timeString.substring(0, 5) : 
                `${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;
        };
        
        // Llenar el formulario
        document.getElementById('doctor_id').value = data.doctor_id;
        document.getElementById('organization_unit_id').value = data.organization_unit_id;
        document.getElementById('day').value = data.day;
        document.getElementById('shift').value = data.shift;
        document.getElementById('start_time').value = formatTime(data.start_time);
        document.getElementById('closing_time').value = formatTime(data.closing_time);
        
        // Configurar el formulario para edición
        document.getElementById('modalTitle').textContent = 'Editar Horario Médico';
        document.getElementById('scheduleForm').action = `/schedules/actualizar/${data.id}`;
        document.querySelector('input[name="_method"]').value = 'PATCH';
        
        // Mostrar modal con animación
        document.getElementById('scheduleModal').classList.remove('hidden');
        
        // Restaurar opacidad de la fila
        row.classList.remove('opacity-50');
        
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'No se pudo cargar la información del horario',
            icon: 'error',
            confirmButtonText: 'OK',
            background: 'var(--bg-card)',
            color: 'var(--text-primary)'
        });
    }
}

// Función para confirmar eliminación con SweetAlert2
function confirmDelete(scheduleId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#ef4444',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        background: 'var(--bg-card)',
        color: 'var(--text-primary)',
        showClass: {
            popup: ' '
        },
        hideClass: {
            popup: 'animate-fade-out'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar loader
            const row = document.querySelector(`tr[data-id="${scheduleId}"]`);
            row.classList.add('opacity-50', 'bg-red-100', 'dark:bg-red-900/20');
            
            // Enviar formulario de eliminación
            document.getElementById(`form-eliminar-${scheduleId}`).submit();
        }
    });
}

// Función para cerrar modal con animación
function closeModal() {
    const modal = document.getElementById('scheduleModal');
    modal.classList.add('opacity-0', 'transition-all', 'duration-300');
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('opacity-0');
    }, 300);
}

// Función para resetear formulario
function resetForm() {
    document.getElementById('scheduleForm').reset();
    document.querySelector('input[name="_method"]').value = 'POST';
}

// Mejorar la experiencia de los selects con búsqueda
document.querySelectorAll('select').forEach(select => {
    select.addEventListener('focus', () => {
        select.size = Math.min(select.options.length, 6);
        select.style.position = 'absolute';
        select.style.zIndex = '10';
        select.classList.add('shadow-lg');
    });
    
    select.addEventListener('blur', () => {
        select.size = 1;
        select.style.position = '';
        select.style.zIndex = '';
        select.classList.remove('shadow-lg');
    });
    
    select.addEventListener('change', () => {
        select.size = 1;
        select.style.position = '';
        select.style.zIndex = '';
        select.classList.remove('shadow-lg');
    });
});

// Optimización para móviles
function checkMobile() {
    if (window.innerWidth < 768) {
        document.querySelectorAll('.calendar-cell').forEach(cell => {
            cell.classList.remove('min-h-[80px]');
            cell.classList.add('min-h-[40px]', 'text-xs');
        });
    }
}

window.addEventListener('resize', checkMobile);
window.addEventListener('load', checkMobile);
</script>
@endpush