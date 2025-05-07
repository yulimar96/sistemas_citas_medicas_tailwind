@extends('layouts.app')

@section('title', 'Gestión de Doctores')

@push('css')
  <style>
        /* Asegúrate de que la transición de opacidad esté definida */
        .alert {
            opacity: 1;
            transition: opacity 0.5s ease;
        }
    </style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <!-- Breadcrumbs -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Inicio
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Doctores</span>
                    </div>
                </li>
            </ol>
        </nav>

          <div class="p-4 border-0 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <!-- Mensajes de éxito y error -->
                @if (session('success'))
                    <div class="alert fixed top-16 right-4 bg-green-500 text-white p-4 rounded shadow-lg" role="alert">
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert fixed top-16 right-4 bg-red-500 text-white p-4 rounded shadow-lg" role="alert">
                        <div class="ms-3 text-sm font-medium">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
    </div>

        <!-- Header y Acciones -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Doctores</h1>
                <p class="text-gray-600 dark:text-gray-400">Administración del personal médico</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <button data-modal-target="doctor-modal" data-modal-toggle="doctor-modal" 
                    class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition-all">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nuevo Doctor
                </button>
                <button id="toggle-view" class="flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 focus:outline-none dark:focus:ring-gray-800 transition-all">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="view-text">Vista de Tarjetas</span>
                </button>
            </div>
        </div>

        <!-- Vista de Tabla (Predeterminada) -->
        <div id="table-view" class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre</th>
                            <th scope="col" class="px-6 py-3">Identificación</th>
                            <th scope="col" class="px-6 py-3">Especialidad</th>
                            <th scope="col" class="px-6 py-3">Teléfono</th>
                            <th scope="col" class="px-6 py-3">Estado</th>
                            <th scope="col" class="px-6 py-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center dark:bg-blue-900">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            {{ $doctor->person->surname_1 }} {{ $doctor->person->name_1 }}
                                        </div>
                                        <div class="text-gray-500 dark:text-gray-400">
                                            {{ $doctor->speciality->name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $doctor->person->nacionality }}-{{ number_format($doctor->person->identification_number, 0, '', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $doctor->speciality->name ?? 'Sin especialidad' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $doctor->person->phone_area_codes }} {{ $doctor->person->phone_number }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'active' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                        'inactive' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                        'suspended' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
                                    ];
                                @endphp
                                <span class="px-2.5 py-0.5 text-xs font-medium rounded-full {{ $statusClasses[$doctor->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                    {{ ucfirst($doctor->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="#" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300 p-1 rounded hover:bg-yellow-50 dark:hover:bg-yellow-900/20">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20" onclick="return confirm('¿Eliminar este doctor?')">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Vista de Tarjetas (Oculta Inicialmente) -->
        <div id="card-view" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($doctors as $doctor)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 p-6 relative hover:shadow-lg transition-shadow">
                <div class="absolute top-3 right-3">
                    @php
                        $statusClasses = [
                            'active' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                            'inactive' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                            'suspended' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
                        ];
                    @endphp
                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full {{ $statusClasses[$doctor->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ ucfirst($doctor->status) }}
                    </span>
                </div>

                <div class="flex items-start mb-4">
                    <div class="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center dark:bg-blue-900">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ $doctor->person->surname_1 }}, {{ $doctor->person->name_1 }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $doctor->person->nacionality }}-{{ number_format($doctor->person->identification_number, 0, '', '.') }}
                        </p>
                    </div>
                </div>

                <div class="mb-4 space-y-2">
                    <p class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2 text-blue-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        {{ $doctor->person->phone_area_codes }} {{ $doctor->person->phone_number }}
                    </p>
                    <p class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2 text-blue-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        {{ $doctor->person->user->email ?? 'N/A' }}
                    </p>
                    <p class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2 text-yellow-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $doctor->speciality->name ?? 'General' }}
                    </p>
                </div>

                <div class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Registrado el {{ $doctor->created_at->format('d/m/Y') }}
                    </div>
                    <div class="flex space-x-2">
                        <a href="#" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300 p-1 rounded hover:bg-yellow-50 dark:hover:bg-yellow-900/20">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20" onclick="return confirm('¿Eliminar este doctor?')">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('management.doctor.create')
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Alternar entre vistas
        const toggleButton = document.getElementById('toggle-view');
        const tableView = document.getElementById('table-view');
        const cardView = document.getElementById('card-view');
        
        if (toggleButton && tableView && cardView) {
            toggleButton.addEventListener('click', function() {
                const isTableViewVisible = !tableView.classList.contains('hidden');
                
                // Animación de transición
                if (isTableViewVisible) {
                    tableView.classList.add('opacity-0', 'scale-95', 'transition-all', 'duration-300');
                    setTimeout(() => {
                        tableView.classList.add('hidden');
                        tableView.classList.remove('opacity-0', 'scale-95');
                        cardView.classList.remove('hidden');
                        cardView.classList.add('animate-fadeIn');
                    }, 300);
                } else {
                    cardView.classList.add('opacity-0', 'scale-95', 'transition-all', 'duration-300');
                    setTimeout(() => {
                        cardView.classList.add('hidden');
                        cardView.classList.remove('opacity-0', 'scale-95', 'animate-fadeIn');
                        tableView.classList.remove('hidden');
                        tableView.classList.add('animate-fadeIn');
                    }, 300);
                }
                
                // Actualizar texto e ícono del botón
                const icon = toggleButton.querySelector('svg');
                const text = toggleButton.querySelector('.view-text');
                
                if (isTableViewVisible) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>';
                    text.textContent = 'Vista de Tabla';
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>';
                    text.textContent = 'Vista de Tarjetas';
                }
            });
        }

        // Auto-ocultar mensajes flash después de 5 segundos
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
@endpush