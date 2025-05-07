@extends('layouts.app')

@section('title', 'Tipos de Unidades Organizativas')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    <style>
        .alert {
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        /* Estilos generales */
        .hq-card {
            transition: all 0.3s ease;
        }

        .hq-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .unit-type-badge {
            transition: all 0.2s ease;
        }

        .unit-type-badge:hover {
            transform: scale(1.05);
        }

        /* Loading spinner */
        .spinner {
            display: none;
            width: 1.5rem;
            height: 1.5rem;
            border: 0.25rem solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Empty state
                                                .empty-state {
                                                    transition: all 0.3s ease;
                                                }

                                                .empty-state:hover {
                                                    transform: scale(1.02);
                                                }

                                                /* ESTILOS COMPACTOS SOLO PARA EL CALENDARIO */
        /* #calendar {
                                            font-size: 0.85em;
                                        }

                                        .fc-header-toolbar {
                                            margin-bottom: 0.5em !important;
                                        }

                                        .fc-toolbar-title {
                                            font-size: 1.2em;
                                        }

                                        .fc-button {
                                            padding: 0.3em 0.6em;
                                        }

                                        /* Celdas del calendario más compactas */
        /* .fc-daygrid-day-frame {
                                            min-height: 50px !important;
                                            padding: 2px;
                                        }

                                        .fc-daygrid-day-number {
                                            font-size: 0.9em;
                                            padding: 2px;
                                        } */
        */
        /* Eventos más compactos */
        /* .fc-event {
                                            margin: 1px;
                                            padding: 1px;
                                            border-radius: 2px;
                                            font-size: 0.75em;
                                        }

                                        .fc-event-content {
                                            padding: 1px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                        }

                                        .fc-event-title {
                                            font-weight: bold;
                                            margin-bottom: 1px;
                                            white-space: nowrap;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                        } */

        /* .fc-event-time {
                                            color: #555;
                                            font-size: 0.8em;
                                        }

                                        .fc-event-speciality {
                                            font-style: italic;
                                            font-size: 0.8em;
                                        } */



        /* Asegurar que los colores se muestren en todas las vistas */
        /* .fc-daygrid-event {
                                            background-color: var(--fc-event-bg-color);
                                            border-color: var(--fc-event-border-color);
                                        } */
    </style>
@endpush

@section('content')
    <div class="p-4">
        <!-- Header con breadcrumbs -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-white">
                        <i class="fas fa-home mr-2"></i>
                        Inicio
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-angle-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Unidades
                            citas medicas</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="p-4 border-0 border-gray-200 border-dashed rounded-lg dark:border-gray-700 ">
            @if (session('success'))
                <div class="alert fixed top-16 right-4 bg-green-500 text-white p-4 rounded shadow-lg" role="alert"
                    id="success-alert">
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="alert fixed top-16 right-4 bg-red-500 text-white p-4 rounded shadow-lg" role="alert"
                    id="error-alert">
                    <div class="ms-3 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert fixed top-16 right-4 bg-yellow-500 text-white p-4 rounded shadow-lg" role="alert"
                    id="warning-alert">
                    <div class="ms-3 text-sm font-medium">
                        {{ session('warning') }}
                    </div>
                </div>
            @endif
        </div>
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Reserva de citas medicas</h1>
                <p class="text-gray-600 dark:text-gray-400">Gestión de citas medicas para los pacientes</p>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="grid grid-cols-1 gap-6" id="hq-container">

            <div
                class="max-w-7xl p-6 bg-blue-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="flex items-center justify-center h-24 rounded bg-blue-200 dark:bg-blue-700">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Horarios Activos de los Doctores</h1>
                    </div>
                    <div class="flex items-center justify-center h-24 rounded">
                        <i class="fas fa-calendar-alt text-4xl text-gray-800 dark:text-white"></i>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button data-modal-target="registar_cita" data-modal-toggle="registar_cita"
                            class="flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none 
                            focus:ring-4 focus:ring-blue-300 text-white font-semibold rounded-lg text-sm px-6 py-3 transition duration-300 ease-in-out shadow-lg 
                            transform hover:scale-105 active:scale-95"
                            type="button">
                            <i class="fas fa-plus mr-2"></i>
                            Crear una cita medica
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="data-table min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="py-3 px-4 text-left">{{ __('Id') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Doctor') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Especialidad') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Fecha y Hora') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Estado') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $con= 1;?>
                            @foreach ($events as $event)
                            {{-- @if (Auth::user()->employee->doctor == $event->doctor_id ) --}}
                                
                            
                                <tr
                                    class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $con++ }}
                                    </td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $event['doctor']['name'] ?? $event['title'] }}
                                    </td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $event['doctor']['speciality'] ?? 'Sin especialidad' }}
                                    </td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ \Carbon\Carbon::parse($event['start'])->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        @php
                                            $statusInfo = [
                                                'pendiente' => [
                                                    'class' => 'bg-yellow-100 text-yellow-800',
                                                    'text' => 'Pendiente',
                                                ],
                                                'confirmada' => [
                                                    'class' => 'bg-green-100 text-green-800',
                                                    'text' => 'Confirmada',
                                                ],
                                                'completada' => [
                                                    'class' => 'bg-blue-100 text-blue-800',
                                                    'text' => 'Completada',
                                                ],
                                                'cancelada' => [
                                                    'class' => 'bg-red-100 text-red-800',
                                                    'text' => 'Cancelada',
                                                ],
                                            ];

                                            $currentStatus = strtolower(
                                                $event['extendedProps']['status'] ?? ($event->status ?? 'pendiente'),
                                            );
                                            $statusConfig = $statusInfo[$currentStatus] ?? [
                                                'class' => 'bg-gray-100',
                                                'text' => $currentStatus,
                                            ];
                                        @endphp

                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusConfig['class'] }}">
                                            {{ $statusConfig['text'] }}
                                        </span>

                                        @if ($event['extendedProps']['deleted'] ?? false)
                                            <span class="ml-2 text-xs text-red-500">(Archivada)</span>
                                        @endif
                                    </td>
                                    <td
                                        class="whitespace-nowrap flex items-center space-x-2 py-2 px-4 border-b border-gray-300">
                                        <button data-modal-target="appointment_modal" data-modal-toggle="appointment_modal"
                                            class="text-blue-700 hover:text-blue-800 focus:outline-none" type="button"
                                            onclick="editarCita({{ $event['id'] }})">
                                            <box-icon name='edit-alt' type='solid' color='#e8e405'></box-icon>
                                        </button>
                                        <form method="POST"
                                            action="{{ route('appointments.destroy', ['id' => $event['id']]) }}"
                                            class="form-eliminar" id="form-eliminar-{{ $event['id'] }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" style="background: none; border: none;"
                                                onclick="confirmDelete({{ $event['id'] }})">
                                                <box-icon name='trash-alt' type='solid' color='#e80505'></box-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            {{-- @endif --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div
                class="max-w-7xl p-6 bg-blue-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- Contenedor para el Dropdown -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <!-- Contenedor para el Dropdown -->
                    <div class="flex items-center justify-center h-24 rounded bg-blue-200 dark:bg-blue-700">
                        <label for="doctor-filter" class="text-gray-800 dark:text-white text-sm">Filtrar por Doctor:</label>
                    </div>
                    <div class="flex items-center justify-center h-24 rounded">
                        <i class="fas fa-calendar-alt text-4xl text-gray-800 dark:text-white"></i>
                    </div>
                    <div class="flex justify-center mt-4">
                        <select name="doctor_id" id="doctor_filter" required
                            class="doctor-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" disabled selected>-- Seleccione un médico --</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ is_array($doctor) ? $doctor['id'] : $doctor->id }}"
                                    data-speciality="{{ is_array($doctor) ? $doctor['speciality'] ?? '' : $doctor->speciality->name ?? '' }}">

                                    {{ is_array($doctor) ? $doctor['name'] : $doctor->person->full_name }}

                                    @if (is_array($doctor))
                                        | {{ $doctor['speciality'] ?? 'Sin especialidad' }}
                                    @else
                                        | {{ $doctor->speciality->name ?? 'Sin especialidad' }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id='calendar'>
                    <div id="doctor_info"></div>
                </div>
            </div>
        </div>
    </div>

    @include('service.appointments.create')
@endsection

@push('js')
    <script src="{{ asset('full-calendar/es.global.min.js') }}"></script>
   <script>
        // Inicializa el calendario una sola vez
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            events: [], // Inicialmente vacío
        });
        calendar.render(); // Renderiza el calendario

        document.getElementById('doctor_filter').onchange = function() {
            let selectedValue = this.value;
            let url = "{{ route('upload_reserva_doctores', ':id') }}";
            url = url.replace(':id', selectedValue);

            console.log('Valor seleccionado:', selectedValue);
            console.log('URL generada:', url);

            if (selectedValue) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log('Datos recibidos:', data);
                        // Limpia los eventos existentes
                        calendar.removeAllEvents();
                        // Agrega los nuevos eventos
                        calendar.addEventSource(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                        alert('Error al obtener los datos del consultorio. Por favor, inténtelo de nuevo más tarde.');
                    }
                });
            } else {
                // Limpia los eventos si no hay doctor seleccionado
                calendar.removeAllEvents();
            }
        };
    </script>
@endpush
