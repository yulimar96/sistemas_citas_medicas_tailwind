@extends('layouts.app')

@push('css')
    <!-- CDN optimizados con preconnect -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <!-- Estilos personalizados optimizados -->
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --secondary: #f59e0b;
            --success: #10b981;
            --warning: #f97316;
            --danger: #ef4444;
            --info: #0ea5e9;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --bg-light: #f9fafb;
            --bg-card: #ffffff;
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }
        
        .dark {
            --primary: #818cf8;
            --primary-hover: #6366f1;
            --text-primary: #f3f4f6;
            --text-secondary: #d1d5db;
            --bg-light: #111827;
            --bg-card: #1f2937;
        }
        
        /* Transiciones básicas */
        .transition-all {
            transition: all 0.2s ease;
        }
        
        /* Efectos hover básicos */
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .btn-hover:hover {
            transform: translateY(-1px);
        }
        
        /* Badges coloridos */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-primary {
            background-color: #e0e7ff;
            color: #4f46e5;
        }
        
        .badge-secondary {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .badge-success {
            background-color: #d1fae5;
            color: #059669;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        /* Botones con gradiente */
        .btn-gradient {
            background-image: var(--gradient-primary);
            color: white;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: opacity 0.2s ease;
        }
        
        .btn-gradient:hover {
            opacity: 0.9;
        }
        
        /* Calendario compacto */
        .calendar-cell {
            padding: 0.25rem;
            border: 1px solid #e5e7eb;
            text-align: center;
            min-height: 40px;
            font-size: 0.75rem;
        }
        
        .dark .calendar-cell {
            border-color: #374151;
        }
        
        /* Scroll personalizado */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f3f4f6;
        }
        
        .dark ::-webkit-scrollbar-track {
            background: #1f2937;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }
        
        .dark ::-webkit-scrollbar-thumb {
            background: #4b5563;
        }
    </style>
@endpush

@section('title', 'Gestión de Horarios Médicos')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Encabezado simplificado -->
    <header class="mb-6 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-4 text-white">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold">
                    <i class="fas fa-calendar-alt mr-2"></i> Gestión de Horarios Médicos
                </h1>
                <p class="mt-1 text-sm opacity-90">
                    Administra y visualiza los horarios de atención de los médicos
                </p>
            </div>
            <button 
                id="createScheduleBtn"
                class="btn-gradient flex items-center px-4 py-2 text-sm shadow"
                aria-label="Crear nuevo horario"
            >
                <i class="fas fa-plus mr-2"></i>
                Crear Horario
            </button>
        </div>
    </header>

    <!-- Notificaciones simplificadas -->
    <div class="fixed top-4 right-4 space-y-2 z-50" id="notifications">
        @if (session('success'))
            <div class="bg-emerald-500 text-white p-3 rounded-lg shadow flex items-center max-w-xs text-sm">
                <i class="fas fa-check-circle mr-2"></i>
                <div class="flex-1">
                    {{ session('success') }}
                </div>
                <button class="ml-2 opacity-70 hover:opacity-100" aria-label="Cerrar notificación">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="bg-red-500 text-white p-3 rounded-lg shadow flex items-center max-w-xs text-sm">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <div class="flex-1">
                    {{ session('error') }}
                </div>
                <button class="ml-2 opacity-70 hover:opacity-100" aria-label="Cerrar notificación">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- Sección principal optimizada -->
    <main class="space-y-6">
        <!-- Tarjeta de horarios activos -->
        <section class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <!-- Header de la tarjeta -->
            <div class="border-b border-gray-200 dark:border-gray-700 px-4 py-3">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                            <i class="fas fa-list-alt mr-2 text-indigo-500"></i> Horarios Activos
                        </h2>
                    </div>
                    
                    <!-- Barra de búsqueda única -->
                    <div class="relative w-full md:w-64">
                        <label for="searchSchedule" class="sr-only">Buscar horario</label>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            id="searchSchedule" 
                            placeholder="Buscar médico o especialidad..." 
                            class="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 text-sm"
                        >
                    </div>
                </div>
            </div>
            
            <!-- Tabla responsiva -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 data-table">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Médico
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Especialidad
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Consultorio
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Horario
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($schedules as $schedule)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700" data-id="{{ $schedule->id }}">
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $schedule->id }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                        <span class="text-indigo-600 dark:text-indigo-300 text-xs font-medium">
                                            {{ substr($schedule->doctor->person->name_1, 0, 1) }}{{ substr($schedule->doctor->person->surname_1, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $schedule->doctor->person->name_1 }} {{ $schedule->doctor->person->surname_1 }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $schedule->doctor->specialitys ? $schedule->doctor->specialitys->name : 'Sin especialidad' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <span class="badge badge-primary">
                                    {{ $schedule->doctor->specialitys ? $schedule->doctor->specialitys->name : 'Sin especialidad' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <div>
                                    {{ $schedule->organizationalUnit ? $schedule->organizationalUnit->name : 'Sin consultorio' }}
                                    @if($schedule->organizationalUnit && $schedule->organizationalUnit->location)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $schedule->organizationalUnit->location }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-1">
                                    <span class="font-medium">{{ substr($schedule->start_time, 0, 5) }}</span>
                                    <span class="text-gray-400">-</span>
                                    <span class="font-medium">{{ substr($schedule->closing_time, 0, 5) }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">
                                        ({{ ucfirst($schedule->day) }})
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-1">
                                    <button 
                                        class="text-indigo-500 hover:text-indigo-700 dark:hover:text-indigo-400 p-1 rounded hover:bg-indigo-50 dark:hover:bg-indigo-900/20"
                                        aria-label="Editar horario"
                                        onclick="editarHorario({{ $schedule->id }})"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <button 
                                        type="button"
                                        class="text-red-500 hover:text-red-700 dark:hover:text-red-400 p-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20"
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
            
            <!-- Paginación simplificada -->
            @if($schedules->hasPages())
            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between text-sm">
                <div class="text-gray-700 dark:text-gray-300">
                    Mostrando {{ $schedules->firstItem() }} a {{ $schedules->lastItem() }} de {{ $schedules->total() }}
                </div>
                <div class="flex space-x-1">
                    @if($schedules->onFirstPage())
                        <span class="px-2 py-1 rounded border border-gray-300 dark:border-gray-600 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-left"></i>
                        </span>
                    @else
                        <a href="{{ $schedules->previousPageUrl() }}" class="px-2 py-1 rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    @endif
                    
                    @foreach(range(1, min(5, $schedules->lastPage())) as $page)
                        <a href="{{ $schedules->url($page) }}" class="px-2 py-1 rounded border {{ $schedules->currentPage() == $page ? 'bg-indigo-500 text-white border-indigo-500' : 'border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                            {{ $page }}
                        </a>
                    @endforeach
                    
                    @if($schedules->hasMorePages())
                        <a href="{{ $schedules->nextPageUrl() }}" class="px-2 py-1 rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <i class="fas fa-angle-right"></i>
                        </a>
                    @else
                        <span class="px-2 py-1 rounded border border-gray-300 dark:border-gray-600 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    @endif
                </div>
            </div>
            @endif
        </section>
        
        <!-- Calendario compacto -->
        <section class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="border-b border-gray-200 dark:border-gray-700 px-4 py-3">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    <i class="fas fa-calendar-week mr-2 text-indigo-500"></i> Vista Semanal
                </h2>
            </div>
            
            <div class="overflow-x-auto p-2">
                <div class="min-w-full grid grid-cols-8 gap-px text-xs">
                    <!-- Header de días -->
                    <div class="col-span-1"></div>
                    @foreach(['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
                    <div class="text-center font-medium py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        {{ $day }}
                    </div>
                    @endforeach
                    
                    <!-- Filas de horas -->
                    @php
                        $times = [
                            '08:00 - 09:00',
                            '09:00 - 10:00',
                            '10:00 - 11:00',
                            '11:00 - 12:00',
                            '12:00 - 13:00',
                            '13:00 - 14:00',
                            '14:00 - 15:00',
                            '15:00 - 16:00',
                            '16:00 - 17:00',
                            '17:00 - 18:00',
                        ];
                    @endphp
                    
                    @foreach ($times as $time)
                    <div class="p-1 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                        {{ explode(' - ', $time)[0] }}
                    </div>
                    
                    @foreach(['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'] as $day)
                    @php
                        $doctor = null;
                        foreach ($schedules as $schedule) {
                            if (strtolower($schedule->day) == $day) {
                                $start = substr($schedule->start_time, 0, 5);
                                $end = substr($schedule->closing_time, 0, 5);
                                if ($time == "$start - $end") {
                                    $doctor = $schedule->doctor;
                                    break;
                                }
                            }
                        }
                    @endphp
                    <div class="calendar-cell group {{ $doctor ? 'bg-emerald-50 dark:bg-emerald-900/20' : 'bg-gray-50 dark:bg-gray-700/50' }}">
                        @if($doctor)
                            <div class="truncate text-emerald-700 dark:text-emerald-300 font-medium">
                                {{ substr($doctor->person->name_1, 0, 1) }}.{{ substr($doctor->person->surname_1, 0, 1) }}
                            </div>
                        @else
                            <span class="text-gray-400">&mdash;</span>
                        @endif
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Modal optimizado -->
<div id="scheduleModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600 bg-indigo-500 dark:bg-indigo-600">
                <h3 class="text-lg font-semibold text-white" id="modalTitle">
                    Nuevo Horario
                </h3>
                <button type="button" class="text-white bg-transparent hover:bg-indigo-600 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="scheduleForm" method="POST" action="">
                    @method('PATCH')
                    @csrf
                    
                    <div class="space-y-4">
                        <!-- Campo Médico -->
                        <div>
                            <label for="doctor_id" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                Médico <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="doctor_id" 
                                name="doctor_id" 
                                required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            >
                                <option value="" disabled selected>Seleccione un médico</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->person->name_1 }} {{ $doctor->person->surname_1 }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Campo Consultorio -->
                        <div>
                            <label for="organization_unit_id" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                Consultorio <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="organization_unit_id" 
                                name="organization_unit_id" 
                                required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            >
                                <option value="" disabled selected>Seleccione un consultorio</option>
                                @foreach ($organizational_unit as $unit)
                                <option value="{{ $unit->id }}">
                                    {{ $unit->name }} ({{ $unit->location }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Día y Turno en una fila -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Día de la semana -->
                            <div>
                                <label for="day" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Día <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    id="day" 
                                    name="day" 
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="lunes">Lunes</option>
                                    <option value="martes">Martes</option>
                                    <option value="miércoles">Miércoles</option>
                                    <option value="jueves">Jueves</option>
                                    <option value="viernes">Viernes</option>
                                    <option value="sábado">Sábado</option>
                                    <option value="domingo">Domingo</option>
                                </select>
                            </div>
                            
                            <!-- Turno -->
                            <div>
                                <label for="shift" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Turno <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    id="shift" 
                                    name="shift" 
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="morning">Mañana</option>
                                    <option value="afternoon">Tarde</option>
                                    <option value="night">Noche</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Horas en una fila -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Hora de inicio -->
                            <div>
                                <label for="start_time" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Inicio <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="time" 
                                    id="start_time" 
                                    name="start_time" 
                                    required
                                    step="300"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >
                            </div>
                            
                            <!-- Hora de fin -->
                            <div>
                                <label for="closing_time" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Fin <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="time" 
                                    id="closing_time" 
                                    name="closing_time" 
                                    required
                                    step="300"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex justify-end gap-2">
                        <button 
                            type="button"
                            onclick="closeModal()"
                            class="px-3 py-1.5 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 text-sm"
                        >
                            Cancelar
                        </button>
                        <button 
                            type="submit"
                            class="px-3 py-1.5 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm"
                        >
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Formularios ocultos para eliminación -->
@foreach ($schedules as $schedule)
<form method="POST" action="{{ route('doctor_schedule.destroy', ['id' => $schedule->id]) }}" id="form-eliminar-{{ $schedule->id }}" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endforeach

@endsection

@push('js')
<!-- Scripts optimizados con carga diferida -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<script>
// Función para editar horario
async function editarHorario(scheduleId) {
    try {
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
        document.getElementById('modalTitle').textContent = 'Editar Horario';
        document.getElementById('scheduleForm').action = `/schedules/actualizar/${data.id}`;
        document.querySelector('input[name="_method"]').value = 'PATCH';
        
        // Mostrar modal
        document.getElementById('scheduleModal').classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'No se pudo cargar la información del horario',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
}

// Función para confirmar eliminación
function confirmDelete(scheduleId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#ef4444',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-eliminar-${scheduleId}`).submit();
        }
    });
}

// Función para cerrar modal
function closeModal() {
    document.getElementById('scheduleModal').classList.add('hidden');
}

// Inicialización de DataTables cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Configuración básica de DataTables
    const dataTable = new simpleDatatables.DataTable('.data-table', {
        perPage: 10,
        perPageSelect: [5, 10, 20],
        labels: {
            placeholder: "Buscar...",
            perPage: "{select} por página",
            noRows: "No se encontraron registros",
            info: "Mostrando {start}-{end} de {rows}"
        }
    });
    
    // Búsqueda con debounce para mejor rendimiento
    let searchTimeout;
    document.getElementById('searchSchedule').addEventListener('input', (e) => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            dataTable.search(e.target.value);
        }, 300);
    });
    
    // Botón para crear nuevo horario
    document.getElementById('createScheduleBtn').addEventListener('click', () => {
        document.getElementById('modalTitle').textContent = 'Nuevo Horario';
        document.getElementById('scheduleForm').action = "{{ route('doctor_schedule.store') }}";
        document.querySelector('input[name="_method"]').value = 'POST';
        document.getElementById('scheduleForm').reset();
        document.getElementById('scheduleModal').classList.remove('hidden');
    });
    
    // Cerrar notificaciones automáticamente después de 5 segundos
    setTimeout(() => {
        const notifications = document.querySelectorAll('#notifications > div');
        notifications.forEach(notification => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        });
    }, 5000);
});
</script>
@endpush