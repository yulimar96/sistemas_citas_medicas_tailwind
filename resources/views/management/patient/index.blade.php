@extends('layouts.app')

@section('title', 'Gestión de Pacientes')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Estilos para las tarjetas */
        .stats-card {
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para la tabla */
        .patient-row:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }

        /* Estilos para los botones */
        .btn-primary {
            background-color: #4f46e5;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        /* Estilos para modo oscuro */
        .dark .stats-card {
            background-color: #1e293b;
            border-color: #334155;
        }

        .dark .patient-row:hover {
            background-color: rgba(30, 41, 59, 0.5);
        }
    </style>
@endpush

@section('content')
    <div class="p-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestión de Pacientes</h1>
                <p class="text-gray-600 dark:text-gray-400">Administración de registros médicos de pacientes</p>
            </div>

            <div class="flex gap-3">
                <button
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 flex items-center"
                    data-modal-target="patient-modal" data-modal-toggle="patient-modal">
                    <i class="fas fa-user-plus mr-2"></i> Nuevo Paciente
                </button>
            </div>
        </div>

        <!-- Tarjetas de estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div
                class="stats-card p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow relative">
                <div
                    class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-indigo-500 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <h5 class="mb-2 text-xl font-semibold text-center text-gray-900 dark:text-white mt-4">Total de Pacientes
                </h5>
                <div class="flex justify-center items-center">
                    <span
                        class="bg-indigo-100 text-indigo-800 text-lg font-bold px-4 py-1 rounded-full dark:bg-indigo-900 dark:text-indigo-200">
                        {{ $patientCount }}
                    </span>
                </div>
            </div>

            <div
                class="stats-card p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow relative">
                <div
                    class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-check text-white text-xl"></i>
                </div>
                <h5 class="mb-2 text-xl font-semibold text-center text-gray-900 dark:text-white mt-4">Pacientes Activos</h5>
                <div class="flex justify-center items-center">
                    <span
                        class="bg-green-100 text-green-800 text-lg font-bold px-4 py-1 rounded-full dark:bg-green-900 dark:text-green-200">
                        {{ $activePatients }}
                    </span>
                </div>
            </div>

            <div
                class="stats-card p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow relative">
                <div
                    class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-calendar-day text-white text-xl"></i>
                </div>
                <h5 class="mb-2 text-xl font-semibold text-center text-gray-900 dark:text-white mt-4">Visitas Hoy</h5>
                <div class="flex justify-center items-center">
                    <span
                        class="bg-blue-100 text-blue-800 text-lg font-bold px-4 py-1 rounded-full dark:bg-blue-900 dark:text-blue-200">
                        {{ $todayVisits }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Tabla de pacientes -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Listado de Pacientes</h2>
                <div class="relative">
                    <input type="text" id="patient-search" placeholder="Buscar paciente..."
                        class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full data-table">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Cédula</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Nombre Completo</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Edad</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Género</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Historia Médica</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Contacto</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($patients as $patient)
                            <tr class="patient-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $patient->person->nacionality ?? 'No especificado' }}-{{ $patient->person->identification_number ?? 'No especificado' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        @if($patient->person)
            @php
                $fullName = collect([
                    $patient->person->name_1,
                    $patient->person->name_2,
                    $patient->person->surname_1,
                    $patient->person->surname_2
                ])->filter()->implode(' ');
            @endphp
            {{ $fullName ?: 'Nombre incompleto' }}
        @else
            No especificado
        @endif
            </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
               @if($patient->person)
            {{ $patient->person->formatted_birth_date }}
            <span class="text-gray-400">({{ $patient->person->age ?? '?' }} años)</span>
        @else
            N/A
        @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span
                    class="px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $patient->person->sex == 1 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200' }}">
                    {{ $patient->person->sex == 1 ? 'Masculino' : 'Femenino' }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600 dark:text-indigo-400">
                {{ $patient->medical_history }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center">
                    <i class="fas fa-phone-alt mr-2 text-gray-400"></i>
                    {{ $patient->person->cell_phone_area_codes }}-{{ $patient->person->cellphone_number }}
                </div>
                <div class="flex items-center mt-1">
                    <i class="fas fa-envelope mr-2 text-gray-400"></i>
                    {{ $patient->person->user->email ?? 'Sin email' }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex space-x-2">
                    <button data-modal-target="show-modal" data-modal-toggle="show-modal"
                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                        onclick="showPatient({{ $patient->id }})">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                        class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                        onclick="editPatient({{ $patient->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form method="POST" action="{{ route('patient.destroy', $patient->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                            onclick="confirmDelete({{ $patient->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
            {{ $patients->links() }}
        </div>
    </div>
    </div>

    @include('management.patient.create')
    @include('management.patient.edit')
    @include('management.patient.show')

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Inicializar DataTable
        new simpleDatatables.DataTable(".data-table", {
            searchable: true,
            fixedHeight: false,
            perPage: 10,
            labels: {
                placeholder: "Buscar...",
                perPage: "{select} registros por página",
                noRows: "No se encontraron registros",
                info: "Mostrando {start} a {end} de {rows} registros",
            }
        });

        // Confirmación de eliminación
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        // Mostrar paciente
        function showPatient(id) {
            fetch(`/patient/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Llenar el modal con los datos del paciente
                    document.getElementById('show-name').textContent = data.person.full_name;
                    // ... completar con más campos

                    // Mostrar el modal
                    const modal = new Modal(document.getElementById('show-modal'));
                    modal.show();
                });
        }

        // Editar paciente
        function editPatient(id) {
            fetch(`/patient/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Llenar el formulario de edición
                    document.getElementById('edit-name').value = data.person.name;
                    // ... completar con más campos

                    // Mostrar el modal
                    const modal = new Modal(document.getElementById('edit-modal'));
                    modal.show();
                });
        }

        // Inicializar Select2 para los selects
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'classic',
                width: '100%'
            });
        });
    </script>
@endpush
